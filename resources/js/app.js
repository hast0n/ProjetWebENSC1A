require('./bootstrap');


window.axios = require('axios').default;
window.Vue = require('vue');

window.EventHandler = new class {
    constructor() {
        this.vue = new Vue();
    }

    fire(event, data=null) {
        this.vue.$emit(event, data);
    }

    listen(event, callback) {
        this.vue.$on(event, callback);
    }
};

Vue.component('question-create', require('./components/create/QuestionCreate.vue').default);
Vue.component('question-create-list', require('./components/create/QuestionCreateList.vue').default);
Vue.component('question-list', require('./components/create/QuestionList.vue').default);
Vue.component('question-select', require('./components/create/QuestionSelect.vue').default);
Vue.component('answer-create', require('./components/create/AnswerCreate.vue').default);
Vue.component('question-create-modal', require('./components/create/QuestionCreateModal').default);

Vue.component('question-edit-list', require('./components/create/QuestionEditList').default);

Vue.component('toggler', require('./components/tools/Toggler.vue').default);
Vue.component('modal', require('./components/tools/Modal.vue').default);
Vue.component('info-modal', require('./components/tools/InfoModal.vue').default);
Vue.component('spinner', require('./components/tools/Spinner.vue').default);
Vue.component('timer', require('./components/tools/Timer.vue').default);
Vue.component('base-timer', require('./components/tools/BaseTimer.vue').default);

Vue.component('quiz-play-context', require('./components/play/QuizPlayContext').default);
Vue.component('quiz-play', require('./components/play/QuizPlay').default);
Vue.component('question-play', require('./components/play/QuestionPlay').default);
Vue.component('answer-play', require('./components/play/AnswerPlay').default);
Vue.component('best-scores', require('./components/play/BestScores').default);

const app = new Vue({
    el: '#app',
});
