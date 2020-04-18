<template>
    <div>
        <div class="legend mt-2" >
            <div>
                <p>Nom du jouer</p>
            </div>
            <div class="d-flex">
                <p class="mr-3">Score</p>
                <p>Temps (s)</p>
            </div>
        </div>

        <hr>

        <p v-if="data.length < 1">Il n'y a pas encore de scores enregistrés pour ce quiz...</p>
        <div class="score-list">
            <div class="score-item" v-for="(score, index) in data" :key="index">
                <div>
                    <p v-text="score.name"></p>
                </div>
                <div class="d-flex">
                    <p class="mr-3" v-text="score.pivot.correct_ratio * 100 + '%'"></p>
                    <p style="margin-left: 30px;" v-text="formattedTime(score.pivot.time_passed)"></p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "BestScores",
        props: {
            data: {required: true}
        },

        methods: {
            formattedTime(time) {
                const minutes = Math.floor(time / 60);
                let seconds = time % 60;

                if (seconds < 10) {
                    seconds = `0${seconds}`;
                }

                return `${minutes}:${seconds}`;
            }
        }
    }
</script>

<style scoped>
    .score-list {
        padding: 10px 20px;
    }

    .score-item {
        height: 20px;
        width: 100%;
        color: rgba(0,0,0,0.68);
        display: flex;
        justify-content: space-between;
    }

    .score-item:nth-child(2n) {
        background-color: rgba(0,0,0,0.13)
    }

    .legend {
        color: rgba(0,0,0,0.68);
        margin: 15px 20px 10px 20px;
        display: flex;
        justify-content: space-between;
    }

    .legend > div > p {
        color: rgba(0, 0, 0, 0.43);
        margin-bottom: 0;
    }

    hr {
        padding: 0;
        margin: 0 20px;
    }
</style>
