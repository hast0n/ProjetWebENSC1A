<template>
    <div>
        <button v-if="!quizLive" type="button" class="btn btn-primary start-btn" @click="showStartModal = true">Démarrer le quiz !</button>
        <modal v-if="showStartModal" title="Démarrer le quiz" :okBtn="true" :cancelBtn="true" :closeBtn="false" @ok="StartQuiz" @cancel="showStartModal = false">
            <div class="start-modal-context">
                <h2>Avant de commencer...</h2>
                <p>
                    Les questions vont vous être présentées les unes après les autres mais vous n'aurez pas la possibilité
                    de revenir en arrière. Un chronomètre en haut à droite de l'écran va s'afficher et vous indiquera le
                    temps restant. Une fois ce temps écoulé, vous ne pourrez plus répondre aux questions et le quiz sera
                    terminé.
                </p>
                <p>
                    Pour continuer vers le quiz, cliquez sur "Ok" !
                </p>
            </div>
        </modal>
        <quiz-play v-if="quizLive" :questions="questionData"
                   @userAnsweredQuestion="StoreAnswer"
                   @sessionClosedByUser="CloseQuizContext"
        ></quiz-play>
    </div>
</template>

<script>
    export default {
        name: "quiz-play-context",
        props: {
            quizId: {required: true},
            questionData: {required: true},
        },
        data() {
            return {
                quizLive: false,
                showStartModal: false,
                userGuesses: [],
                correctRatio: 0,
                timePassed: 0
            }
        },
        methods: {
            StartQuiz() {
                this.showStartModal = false;
                this.quizLive = true;
            },

            StoreAnswer(questionId, answersValues) {
                this.userGuesses.push(
                    {id: questionId, guesses: answersValues}
                )
            },

            CloseQuizContext(timePassed) {
                this.quizLive = false;
                this.timePassed = timePassed;
                this.SendGuesses();
            },

            // ComputeScore() {
            //     let score = 0;
            //     this.userGuesses.forEach(q => {
            //         let type = this.questionData.find(i => i.id === q.id).type;
            //         let questionScore = 1;
            //         q.guesses.forEach(g => {
            //             if ((type !== 3 && g.is_right_answer != g.selected) || g.text === g.user_guess) {
            //                 questionScore = 0;
            //             }
            //         });
            //        score += questionScore;
            //     });
            //     this.correctRatio = Math.round(score / this.questionData.length * 100) / 100;
            // },

            SendGuesses() {
                axios.post('/quiz/saveScore', {
                    'quizId': this.quizId,
                    'guesses': this.userGuesses,
                    'timePassed': this.timePassed
                })
                .then(function (response) {
                    // console.log(response.data);
                })
                .catch(error => {
                    console.log(error);
                })
            }
        }
    }
</script>

<style scoped>
    .start-modal-context {
        padding: 20px;
    }

    .start-btn {
        width: 100%;
        height: 50px
    }
</style>

// Dans la modal de fermeture après score, demander avis sur quiz
