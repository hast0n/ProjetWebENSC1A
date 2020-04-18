<template>
    <modal title="Créer une question" @cancel="$emit('close')" @save="Save" :saveBtn="true" :closeBtn="false" :cancelBtn="true">
        <question-create ref="question"></question-create>
    </modal>
</template>

<script>
    export default {
        name: "question-create-modal",
        data() {
            return {
            }
        },
        methods: {
            Save() {
                let statement = this.$refs.question.statement;
                let answers = this.$refs.question.answers;
                let answersType = this.$refs.question.answerType;
                let textareaText = this.$refs.question.textareaText;

                // match all possible error case
                // possibility of 0 correct answers is intended
                if (statement === "") {
                    alert("Veuillez saisir un énoncé, puis réessayez.");
                    return;
                }
                if (!["1", "2", "3"].includes(answersType)) {
                    alert("Mauvais type de question...");
                    return;
                }
                if (answersType === "3" && textareaText === "") {
                    alert("Veuillez saisir la bonne réponse, puis réessayez.");
                    return;
                }
                if (answersType !== "3" && answers.some(a => { return a.text === ""; })) {
                    alert("Complétez les réponses vides, puis réessayez.");
                    return;
                }

                if (answersType !== "3" && answers.length < 1) {
                    alert("Veuillez saisir au moins une réponse, puis réessayez.");
                    return;
                }

                axios.post('/question', {
                    'statement': statement,
                    'answers': answersType === "3" ? [{id: 0, text: textareaText, status: true}] : answers,
                    'answersType': answersType
                })
                .then(response => {
                    this.forwardQuestion(response.data);
                })
                .catch(function (error) {
                    console.log(error);
                });
                //
            },

            forwardQuestion(question) {
                this.$emit('saved', question);
                this.$emit('close')
            }
        }
    }
</script>

<style scoped>

</style>
