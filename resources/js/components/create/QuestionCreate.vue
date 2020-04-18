<template>
    <div class="question-card">
<!--        <div class="question-wrapper">-->
            <div class="question-create-header">
                <div class="question-create-field" style="margin-bottom: 10px">
                    <p>Énoncé de la question :</p>
                    <input type="text" placeholder="Saisissez l'énoncé de votre question..."
                           class="form-control glow" v-model="statement">
                </div>

                <div class="question-create-field">
                    <p>Format de la réponse :</p>
                    <select class="custom-select glow" v-model="answerType" @change="UpdateType">
                        <option value="1" selected>Choix multiples</option>
                        <option value="2">Choix unique</option>
                        <option value="3">Champ de text</option>
                    </select>
                </div>
            </div>
<!--        </div>-->

        <hr>

        <div class="question-create-content">

            <div class="question-create-answers" v-if="answerType === '3'">
                <div class="d-flex w-100 justify-content-between">
                    <p>Réponse :</p>
                    <p>Bonne réponse ?</p>
                </div>
                <textarea placeholder="Saisissez la réponse juste" class="form-control" v-model="textareaText"></textarea>
            </div>

            <div class="question-create-answers" v-if="answerType !== '3'">

                <p>Réponses :</p>

                <answer-create v-for="(ans, index) in answers"
                               :key="ans.id" :obj="ans"
                               :listIndex="index"
                               @updateAnswer="UpdateAnswer"
                               @removeAnswer="RemoveAnswer">
                </answer-create>

                <div class="add-answer">
                    <p @click="AddAnswer">Ajouter une réponse</p>
                </div>

            </div>

        </div>

    </div>
</template>

<script>
    export default {

        name: "question-create",

        data: function () {
            return {
                ctr: 0,
                statement: "",
                answerType: "1",
                lastAnswerType: "1",
                textareaText: "",
                answers: [
                    {id: 0, text: "", status: false}
                ]
            }
        },

        methods: {
            AddAnswer() {
                this.answers.push({id: ++this.ctr, text: "", status: false})
            },

            RemoveAnswer(id) {

                this.answers = this.answers.filter(e => { return e.id !== id});
            },

            UpdateAnswer(values) {
                this.UpdateType();
                for (let i in this.answers) {
                    if (this.answers[i].id === values[0] && this.answers.hasOwnProperty(i)) {
                        this.answers[i].text = values[1];
                        this.answers[i].status = values[2];
                        break;
                    }
                }
                this.UpdateTogglers();
            },

            UpdateType() {
                if (this.answerType === "2") {
                    for (let i in this.answers) {
                        if (this.answers.hasOwnProperty(i)) {
                            this.answers[i].status = false;
                        }
                    }
                    if (this.lastAnswerType !== "3") {
                        this.UpdateTogglers();
                    }
                }
                this.lastAnswerType = this.answerType;
            },

            UpdateTogglers() {
                this.answers.forEach(answer => {
                    let togglerId = this.$children.filter(child => {
                        return child.obj.id === answer.id;
                    })[0].$children[0].id;

                    EventHandler.fire(togglerId, answer.status);
                })
            }
        }
    }
</script>

<style scoped>
    .question-card {
        margin: 0;
        /*box-shadow: rgba(1,1,1,0.1) 1px 1px 6px;*/
        padding: 20px;
        border-radius: 7px;
    }

    div.question-card > p {
        font-size: large;
        color: #b9bbbe;
    }

    /*div.question-wrapper {*/
    /*    border-radius: 10px;*/
    /*    position: relative;*/
    /*    background: linear-gradient(to right, #ff413c, #c900c9);*/
    /*    padding: 0px;*/
    /*}*/

    div.question-create-header {
        padding: 10px;
        background-color: white;
        border-radius: 8px;
    }

    div.question-create-content {
        margin-top: 10px;
        display: flex;
        flex-flow: row;
    }

    div.question-create-content > hr {
        width: 1px;
        height: auto;
        background-color: #b9bbbe;
        margin: 10px 10px 15px 20px;
    }

    div.question-create-content > div > p {
        margin-left: 45px;
        font-size: larger;
    }

    div.question-create-field {
        display: flex;
        align-items: center;
    }

    div.question-create-field > input {
        border: none;
    }

    div.question-create-field > input::placeholder {
        color: rgba(0,0,0,0.41);
    }

    div.question-create-field > p {
        white-space: nowrap;
        margin: 0 5px 0 0;
    }

    div.question-create-field > select {
        width: auto;
    }

    div.question-create-answers {
        width: 100%;
    }

    div.question-create-answers > button {
        margin-left: 45px;
    }

    textarea {
        padding-left: 45px;
        border: none;
        width: 100%;
        -webkit-appearance: none;
    }

    textarea:focus {
        -webkit-appearance: none;
        -webkit-box-shadow: none;
    }

    div.add-answer {
        font-size: medium;
        color: #b9bbbe;
        cursor: pointer;
        margin-left: 10px
    }
</style>
