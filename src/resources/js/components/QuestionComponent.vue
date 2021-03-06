<template>
  <div class="jumbotron">
    <template v-if="!isFinished">
      <h1 class="display-5 text-center">第{{ current_question_num }}問</h1>
      <div v-if="isCorrect" class="alert alert-primary text-center result-message">正解</div>
      <div v-if="isMistake" class="alert alert-danger text-center result-message">不正解</div>
      <h3 class="text-center mt-4">{{ questions[current_question_num - 1].content }} = ?</h3>
      <form class="mt-4">
        <div class="form-row">
          <div class="col-4"></div>
          <div class="col-4">
            <div class="form-group">
              <input ref="inputAnswer" type="text" class="form-control" placeholder="半角で入力" />
            </div>
          </div>
          <div class="col-4"></div>
        </div>
        <div class="text-center mt-3">
          <button
            v-bind:disabled="isChecking"
            v-on:click="answerQuestion"
            type="button"
            class="btn btn-secondary"
          >解答する</button>
        </div>
      </form>
    </template>
    <template v-if="isFinished">
      <div class="card" style="width: 18rem; margin: 0 auto;">
        <div class="card-header text-center">成績</div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">正解数: {{ correct_answer_num }} / {{ questions.length }}</li>
          <li class="list-group-item">平均解答時間: {{ averageAnswerTime }}秒</li>
        </ul>
      </div>
      <div class="text-center mt-4">
        <a
          v-bind:href="`/question?genre=${genreId}&questionsNum=${questions.length}`"
          type="button"
          class="btn btn-outline-secondary"
        >もう一度</a>
        <a href="/" type="button" class="btn btn-outline-secondary">トップページに戻る</a>
      </div>
    </template>
  </div>
</template>

<script>
export default {
  props: {
    baseQuestions: {
      type: Array,
      default: []
    },
    baseGenreId: {
      type: Number,
      default: 0
    }
  },
  data() {
    return {
      questions: this.baseQuestions,
      current_question_num: 1,
      correct_answer_num: 0,
      isCorrect: false,
      isMistake: false,
      isFinished: false,
      startTime: Date.now(),
      totalAnswerTime: 0,
      api_token: document
        .querySelector('meta[name="api-token"]')
        .getAttribute("content"),
      isChecking: false,
      genreId: this.baseGenreId
    };
  },
  computed: {
    averageAnswerTime: function() {
      return (this.totalAnswerTime / this.questions.length / 1000).toFixed(1);
    }
  },
  mounted() {
    this.$refs.inputAnswer.focus();
  },
  methods: {
    answerQuestion() {
      this.isChecking = true;
      // 解答時間の取得
      const now = Date.now();
      this.totalAnswerTime += now - this.startTime;

      const inputAnswer = Number(this.$refs.inputAnswer.value);
      this.checkAnswer(inputAnswer);

      // 厳密な同期処理になってない...setTimeout自体をpromiseでくくる必要あると思う
      this.sleep(750).then(() => {
        this.startTime = Date.now();

        // 最終問題の場合
        if (this.questions.length === this.current_question_num) {
          // 成績をDBに保存する
          const activityData = {
            correct_answer_num: this.correct_answer_num,
            total_answer_num: this.questions.length,
            correct_answer_second: this.averageAnswerTime,
            genre_id: this.genreId
          };
          this.putActivityData(activityData);
          // 成績を表示する
          this.isFinished = true;
        }

        this.$refs.inputAnswer.value = "";
        this.$refs.inputAnswer.focus();
        this.isChecking = false;
        this.current_question_num++;
      });
    },
    putActivityData(data) {
      const headers = {
        Authorization: `Bearer ${this.api_token}`,
        Accept: "application/json"
      };
      axios
        .post("/api/activity", data, {
          headers: headers
        })
        .then(res => {
          console.log(res.data);
        })
        .catch(error => {
          console.log(error);
        });
    },
    checkAnswer(inputAnswer) {
      if (
        inputAnswer === this.questions[this.current_question_num - 1].answer
      ) {
        // 正解の場合
        this.isCorrect = true;
        this.correct_answer_num++;
      } else {
        // 不正解の場合
        this.isMistake = true;
      }
      setTimeout(() => {
        this.isCorrect = false;
        this.isMistake = false;
      }, 750);
    },
    sleep(time) {
      return new Promise((resolve, reject) => {
        setTimeout(resolve, time);
      });
    }
  }
};
</script>

<style scoped>
.result-message {
  width: 25%;
  margin: 0 auto;
}
</style>