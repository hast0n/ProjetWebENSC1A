<template>
    <div class="quiz-challenge-context">
        <div class="my-3">
            <base-timer :time-limit="timeLimit" @timesUp="EndQuizSession"></base-timer>
        </div>
        <div class="quiz-challenge-window shadow-lg">
            <div class="times-up d-flex flex-column justify-content-center align-items-center h-100" v-if="!displayChallenge">
                <p v-if="timesUp">Temps Écoulé !</p>
                <p v-if="!timesUp">Vous avez complété toutes les questions !</p>
                <button class="btn btn-primary px-5 py-2" @click="CloseQuizSession">Terminer</button>
            </div>
            <div class="question-item" v-for="(question, index) in questions" v-if="index === currentQuestion && displayChallenge">
                <question-play @answered="ForwardUserGuess" :key="question.id" :data="question" :index="index"></question-play>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "quiz-play",
        props: {
            questions: {required: true}
        },

        data() {
            return {
                currentQuestion: 0,
                displayChallenge: true,
                timesUp: false,
                timeLimit: 5*60, // seconds
                timePassed: 0,
            }
        },

        methods: {
            ForwardUserGuess(id, values) {
                this.$emit('userAnsweredQuestion', id, values);
                //
                this.NextQuestion();
            },

            NextQuestion() {
                if (this.currentQuestion < this.questions.length - 1) {
                    this.currentQuestion ++;
                }
                else {
                    EventHandler.fire('TimerStopRequest')
                }
            },

            EndQuizSession(timePassed) {
                this.timePassed = timePassed;
                this.timesUp = timePassed === this.timeLimit;
                this.displayChallenge = false;
            },

            CloseQuizSession() {
                this.$emit('sessionClosedByUser', this.timePassed)
            },
        },

    }
</script>

<style scoped>
    .times-up {
        font-size: 3em;
        color: rgba(0,0,0,0.18);
        animation-name: appear;
        animation-duration: 0.3s;
        animation-fill-mode: forwards;
    }

    .question-item {
        height: 100%;
    }

    .quiz-challenge-window {
        /*width: 65vw;*/
        height: 75vh;
        opacity: 0;
        background-color: white;
        border-radius: 10px;
        animation-name: expand;
        animation-duration: 0.3s;
        animation-delay: 1s;
        animation-fill-mode: forwards;
        animation-timing-function: ease-out;
    }

    .quiz-challenge-context {
        display: flex;
        flex-flow: column;
        align-items: center;
        justify-content: center;
        position: fixed;
        z-index: 500;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 255);
        animation-name: appear;
        animation-duration: 1s;
        animation-fill-mode: forwards;
    }

    @keyframes expand {
        from {
            width: 0;
            opacity: 100%
        }
        to {
            width: 65vw;
            opacity: 100%

        }
    }

    @keyframes appear {
        from {
            opacity: 0;
        }
        to {
            opacity: 100%;
        }
    }


</style>
