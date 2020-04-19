<!--From CodeSandbox by mateuszRybczonek at https://codesandbox.io/s/basetimer-no-parent-control-6frgv?from-embed=&file=/src/App.vue-->

<template>
    <div class="base-timer">
        <svg class="base-timer__svg" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
            <g class="base-timer__circle">
                <circle class="base-timer__path-elapsed" cx="50" cy="50" r="45"></circle>
                <path
                    :stroke-dasharray="circleDasharray"
                    class="base-timer__path-remaining"
                    :class="remainingPathColor"
                    d="
            M 50, 50
            m -45, 0
            a 45,45 0 1,0 90,0
            a 45,45 0 1,0 -90,0
          "
                ></path>
            </g>
        </svg>
        <span class="base-timer__label">{{ formattedTimeLeft }}</span>
    </div>
</template>

<script>
    const FULL_DASH_ARRAY = 283;
    const WARNING_THRESHOLD = 10;
    const ALERT_THRESHOLD = 5;

    const COLOR_CODES = {
        info: {
            color: "green"
        },
        warning: {
            color: "orange",
            threshold: WARNING_THRESHOLD
        },
        alert: {
            color: "red",
            threshold: ALERT_THRESHOLD
        }
    };

    let TIME_LIMIT = 0;

    export default {
        props: {
            timeLimit: {required: true}
        },

        data() {
            return {
                timePassed: 0,
                timerInterval: null
            };
        },

        computed: {
            circleDasharray() {
                return `${(this.timeFraction * FULL_DASH_ARRAY).toFixed(0)} 283`;
            },

            formattedTimeLeft() {
                const timeLeft = this.timeLeft;
                const minutes = Math.floor(timeLeft / 60);
                let seconds = timeLeft % 60;

                if (seconds < 10) {
                    seconds = `0${seconds}`;
                }

                return `${minutes}:${seconds}`;
            },

            timeLeft() {
                return TIME_LIMIT - this.timePassed;
            },

            timeFraction() {
                const rawTimeFraction = this.timeLeft / TIME_LIMIT;
                return rawTimeFraction - (1 / TIME_LIMIT) * (1 - rawTimeFraction);
            },

            remainingPathColor() {
                const { alert, warning, info } = COLOR_CODES;

                if (this.timeLeft <= alert.threshold) {
                    return alert.color;
                } else if (this.timeLeft <= warning.threshold) {
                    return warning.color;
                } else {
                    return info.color;
                }
            }
        },

        watch: {
            timeLeft(newValue) {
                if (newValue === 0) {
                    this.onTimesUp();
                }
            }
        },

        created() {
            EventHandler.listen('TimerStopRequest', () => {
                this.onTimesUp();
            })
        },

        mounted() {
            TIME_LIMIT = this.timeLimit;
            this.startTimer();
        },

        methods: {
            onTimesUp() {
                clearInterval(this.timerInterval);
                this.$emit("timesUp", this.timePassed)
            },

            startTimer() {
                this.timerInterval = setInterval(() => (this.timePassed += 1), 1000);
            }
        }
    };
</script>

<style scoped lang="scss">
    $globalWidth: 100px;

    .base-timer {
        position: relative;
        width: $globalWidth;
        height: $globalWidth;

        &__svg {
            transform: scaleX(-1);
        }

        &__circle {
            fill: none;
            stroke: none;
        }

        &__path-elapsed {
            stroke-width: 7px;
            stroke: rgba(0, 0, 0, 0.04);
        }

        &__path-remaining {
            stroke-width: 7px;
            stroke-linecap: round;
            transform: rotate(90deg);
            transform-origin: center;
            transition: 1s linear all;
            fill-rule: nonzero;
            stroke: currentColor;

            &.green {
                color: rgba(60, 180, 132, 0.75);
            }

            &.orange {
                color: orange;
            }

            &.red {
                color: red;
            }
        }

        &__label {
            position: absolute;
            width: $globalWidth;
            height: $globalWidth;
            top: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            color: rgba(0,0,0,0.48)
        }
    }
</style>
