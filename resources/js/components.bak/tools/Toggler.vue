
<template>
    <div class="m-1 align-content-center">
        <!-- From CodePen by watermelonpiza at https://codepen.io/watermelonpizza/pen/abvoWMv?editors=1100-->
        <div class="toggle colour">
            <input :id="id" class="toggle-checkbox hidden" type="checkbox" @change="$emit('toggle', state)" v-model="state">
            <label :for="id" class="toggle-label block w-12 h-6 rounded-full transition-color duration-150 ease-out"></label>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            value: {default: false}
        },
        name: "toggler",
        data: function () {
            return {
                state: this.value,
                id: 0
            }
        },
        created() {
            // https://gist.github.com/gordonbrander/2230317
            this.id = '_' + Math.random().toString(36).substr(2, 9);
            EventHandler.listen(this.id, (value) => {
                this.state = value;
            })
        }
    }
</script>

<style lang="scss" scoped>
    .toggle-label {
        cursor: pointer;
        // @apply relative
        position: relative;

        &:before {
            // @apply absolute
            position: absolute;
            top: 0.125rem;
            left: 0.125rem;

            // @apply block
            display: block;
            content: "";

            // @apply w-5 h-5
            width: 1.25rem;
            height: 1.25rem;

            // @apply rounded-full
            border-radius: 9999%;

            // @apply bg-white bg-center bg-no-repeat
            background-color: white;
            background-position: center;
            background-repeat: no-repeat;

            background-size: 40%;
            background-image: url('data:image/svg+xml;charset=UTF-8,<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="%23a0aec0" stroke-width="6" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>');

            // @apply transition-transform duration-150 ease-out
            transition: transform .15s cubic-bezier(0, 0, 0.2, 1);

            // @apply translate-x-0
            transform: translateX(0);

            // @apply shadow
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),
            0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
    }

    .toggle-checkbox:checked + .toggle-label:before {
        // @apply translate-x-6;
        transform: translateX(1.5rem);
        background-image: url('data:image/svg+xml;charset=UTF-8,<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="%23a0aec0" stroke-width="6" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>');
    }

    .toggle {
        &.slim {
            .toggle-label:before {
                top: -0.15rem;

                // @apply left-0
                left: 0;
            }

            .toggle-checkbox:checked + .toggle-label:before {
                // @apply translate-x-6;
                transform: translateX(1.75rem);
            }
        }

        &.colour {
            .toggle-label {
                // @apply bg-red-300;
                background-color: #feb2b2;
            }

            .toggle-checkbox:checked + .toggle-label {
                // @apply bg-green-300;
                background-color: #9ae6b4;
            }
        }
    }

    .toggle.colour .toggle-label {
        background-color: #feb2b2;
    }
    .toggle-label {
        position: relative;
    }

    .duration-150 {
        transition-duration: 150ms;
    }
    .ease-out {
        transition-timing-function: cubic-bezier(0,0,.2,1);
    }
    .w-12 {
        width: 3rem;
    }
    .h-6 {
        height: 1.5rem;
        margin-bottom: 0;
    }
    .block {
        display: block;
    }
    .rounded-full {
        border-radius: 9999px;
    }

    *, ::after, ::before {
        box-sizing: border-box;
        border-width: 0;
        border-style: solid;
        border-color: #e2e8f0;
    }

    .hidden {
        display: none;
    }
</style>
