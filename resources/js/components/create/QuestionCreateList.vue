<template>
    <div>

        <p>Pour ajouter des questions, sélectionnez-les depuis "Mes questions" ou créez en de nouvelles avec "Créer une question".</p>

        <div class="modal-buttons">
            <button type="button" @click="launchSelectModal" class="btn btn-primary">Mes questions</button>
            <button type="button" @click="launchCreateModal" class="btn btn-primary">Créer une question</button>
        </div>

        <div class="legend mt-5" >
            <div>
                <p>Énoncé de la question</p>
                <p>Type</p>
            </div>
            <p>Supprimer</p>
        </div>

        <hr>

        <p class="empty-message" v-if="displayEmptyQuestionList">Pas de questions à afficher...</p>

        <div class="question-list-item" v-for="question in selectedQuestions"  :key="question.id">
            <question-select @selected="ToggleQuestion" :question="question" :showToggle="false"></question-select>
        </div>

        <question-create-modal v-if="showCreateModal" @close="showCreateModal = false" @saved="HandleIncomingCreatedQuestion"></question-create-modal>

        <modal title="Ajouter des questions" v-if="showSelectModal" :saveBtn="true" :closeBtn="false" @close="showSelectModal = false">
            <div class="legend">
                <div>
                    <p>Énoncé de la question</p>
                    <p>Type</p>
                </div>
                <p>Ajoutée (<span style="color: rgb(154, 230, 180)">Oui</span>/<span style="color: #feb2b2">Non</span>)</p>
            </div>
            <hr>
            <div v-if="!loaded">
                <spinner></spinner>
            </div>
            <div class="question-list-item" v-for="question in userQuestions" v-if="loaded" :key="question.id">
                <question-select @selected="ToggleQuestion" :question="question"></question-select>
            </div>
        </modal>

    </div>
</template>

<script>
    export default {
        name: "question-create-list",
        props: ["quizId", "quizQuestions"],
        data() {
            return {
                showSelectModal: false,
                showCreateModal: false,
                loaded: false,
                userQuestions: [],
                selectedQuestions: [],
            }
        },

        computed: {
            displayEmptyQuestionList() {
                return this.selectedQuestions.length < 1;
            }
        },

        created: function() {
            this.getUserQuestions(() => {
                this.loaded = true;
                this.quizQuestions.forEach(question => {
                    this.addToSelectedQuestions(question.id, false)
                });
            });
        },

        methods: {
            HandleIncomingCreatedQuestion(question) {
                this.getUserQuestions(() => {
                    this.addToSelectedQuestions(question.id);
                });
            },

            launchSelectModal() {
                this.showSelectModal = true;
                this.getUserQuestions();
            },

            launchCreateModal() {
                this.showCreateModal = true;
            },

            ToggleQuestion(id, state) {
                if (state) {
                    this.addToSelectedQuestions(id)
                }
                else {
                    this.removeFromSelectedQuestions(id);
                }
            },

            getUserQuestions(callback) {
                axios.get('/questions/get')
                .then(response => {
                    response.data.forEach(question => {
                        let exists = this.userQuestions.some(q => {
                            return q.id === question.id;
                        });
                        if (!exists) {
                            this.userQuestions.push(question);
                        }
                    });
                    this.userQuestions.forEach(question => {
                        this.getQuestionAnswers(question);
                    })
                })
                .catch(error => {
                    console.log(error, 'Returning empty array.');
                    return [];
                })
                .then(callback);
            },

            addToSelectedQuestions(id, bind = true) {
                let question = this.userQuestions.filter(question => {
                    return question.id === id
                })[0];

                question.selected = true;
                this.selectedQuestions.push(question);

                if (bind) { this.BindQuestion(id); }
            },

            removeFromSelectedQuestions(id, unbind = true) {
                let question = this.userQuestions.filter(question => {
                    return question.id === id
                })[0];

                question.selected = false;
                this.selectedQuestions = this.selectedQuestions.filter(item => {
                    return id !== item.id;
                });

                if (unbind) { this.UnbindQuestion(id); }
            },

            getQuestionAnswers(question, callback) {
                if (question.answers === undefined) {
                    axios.get('/questions/' + question.id + '/answers')
                    .then(response => {
                        question.answers = response.data;
                    })
                    .catch(error => {
                        console.log(error, 'Returning empty array.');
                        return [];
                    })
                    .then(() => {
                        // callback();
                        // this.$forceUpdate()
                        // always executed
                    });
                }
            },

            BindQuestion(id) {
                axios.post('/quiz/edit/addQuestion', {
                    'quizId': this.quizId,
                    'questionId': id
                })
                .then(function (response) {
                    // console.log(response.data);
                })
                .catch(error => {
                    console.log(error);
                })
            },

            UnbindQuestion(id) {
                axios.post('/quiz/edit/removeQuestion', {
                    'quizId': this.quizId,
                    'questionId': id
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
    p {
        margin-bottom: 0;
    }

    .empty-message {
        color: rgba(0,0,0,0.64);
        font-style: italic;
        margin-left: 20px;
        margin-top: 20px
    }

    .legend {
        color: rgba(0,0,0,0.68);
        margin: 15px 20px 10px 20px;
        display: flex;
        justify-content: space-between;
    }

    .legend > div {
        display: flex;
    }

    .legend > div > p:nth-child(2) {
        color: rgba(0,0,0,0.25);
        margin-left: 10px;
    }

    hr {
        padding: 0;
        margin: 0 20px;
    }

    .question-list-item {
        margin: 7px 10px;
    }

    .modal-buttons {
        display: flex;
        width: 100%;
        margin-top: 20px;
        justify-content: center;
    }

    .modal-buttons > button {
        margin-left: 20px
    }
</style>
