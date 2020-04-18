<template>
    <div>
        <div class="edit-list-item my-2" v-for="(question, index) in questions" :key="index">
            <question-select :question="question" @selected="DeleteQuestion" :showToggle="false"></question-select>
        </div>
    </div>
</template>

<script>
    export default {
        name: "QuestionEditList",
        props: {
            data : {required: true}
        },
        data() {
            return {
                questions: this.data,
            }
        },
        methods: {
            DeleteQuestion(id, state) {
                axios.post('/question/destroy', {
                    'id': id,
                })
                .then(response => {
                    this.questions.filter(q => {
                        return q.id !== id;
                    })
                })
                .catch(function (error) {
                    console.log(error);
                });
            }
        }
    }
</script>

<style scoped>
    .edit-list-item {
        /*margin*/
    }
</style>
