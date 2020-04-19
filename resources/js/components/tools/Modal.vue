<template>
<!--    Since I cannot find any good modal template to easily implement, let's create one form scratch-->
    <div class="my-modal">
        <div class="modal-backdrop" @click="close"></div>

        <div class="modal-context large">

            <div class="my-modal-header"><p class="title" v-text="title"></p></div>
            <hr>

            <div class="my-modal-content">
                <slot></slot>
            </div>
            <hr>

            <div class="my-modal-footer">
                <button type="button" v-if="saveBtn" class="modal-btn" @click="save">Enregistrer</button>
                <button type="button" v-if="okBtn" class="modal-btn px-3" @click="ok" v-text="okBtnText"></button>
                <button type="button" v-if="cancelBtn" class="modal-close" @click="cancel">Annuler</button>
                <button type="button" v-if="closeBtn" class="modal-close" @click="close">Fermer</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "modal",
        props: {
            title: {required: true},
            desc: {default: ""},
            closeBtn: {default: true},
            saveBtn: {default: false},
            okBtn: {default: false},
            cancelBtn: {default: false},
        },

        computed: {
            okBtnText() {
                let labels = [
                    "Énorme !", "Énorme !",
                    "Fascinant", "Fascinant",
                    "Renversant", "Renversant",
                    "Nice", "Nice",
                    "Jpp",
                    "Ok", "Ok", "Ok", "Ok", "Ok",
                    "Pourquoi pas...",
                    "Ça part !",
                    "M'en fou"
                ];
                return labels[Math.floor(Math.random() * labels.length)];
            }
        },

        methods: {
            close: function(event) {
                this.$emit('close')
            },

            ok: function(event) {
                this.$emit('ok');
                this.close();
            },

            save: function(event) {
                this.$emit('save');
                this.close();
            },

            cancel: function(event) {
                this.$emit('cancel');
                this.close();
            }
        }
    }
</script>

<style scoped>
    .my-modal {
        display: flex;
        justify-content: center;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 2000;
        overflow-y: scroll;
    }

    .modal-backdrop {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 2010;
        animation-name: fade;
        animation-duration: 0.3s;
        animation-fill-mode: forwards;
    }

    .small {
        width: 25%;
    }

    .large {
        width: 50%;
    }

    .modal-context {
        position: fixed;
        display: flex;
        flex-flow: column;
        justify-content: center;
        align-content: flex-start;
        max-height: 75%;
        height: auto;
        top: 100px;
        background-color: white;
        box-shadow: rgba(1,1,1,0.21) 0 0 10px;
        animation-name: appear;
        animation-timing-function: ease-in-out;
        animation-duration: 0.3s;
        animation-fill-mode: forwards;
        overflow: hidden;
        z-index: 2020;
    }

    @keyframes appear {
        from {
            top: 0;
            width: 0;
            height: 0;
            border-radius: 100%;
        }
        to {
            height: auto;
            border-radius: 10px;
        }
    }

    @keyframes fade {
        from {
            background-color: rgba(0,0,0,0);
        }
        to {
            background-color: rgba(0,0,0,0.21);
        }
    }

    .modal-context > hr {
        margin: 0;
        padding: 0
    }

    .my-modal-content {
        width: 100%;
        overflow-x: hidden;
        max-height: 60vh
    }

    .my-modal-header, .my-modal-footer {
        display: flex;
        align-content: center;
        height: 70px;
        width: 100%;
    }

    .modal-btn {
        background-color: rgba(255,65,60,0.89);
        border-radius: 7px;
        padding: 10px;
        margin: auto 10px auto 0;
        border: none;
        color: white;
        transition: color 0.1s ease;
    }

    .modal-btn:hover {
        color: rgba(255,255,255,0.78)
    }

    .modal-btn:active {
        background-color: rgb(224, 46, 46);
    }

    .modal-close {
        background-color: rgb(221, 221, 221);
        border-radius: 7px;
        padding: 10px;
        margin: auto 10px auto 0;
        color: rgba(76,76,76,0.78);
        border: none;
        transition: color 0.1s ease;
    }

    .modal-close:hover {
        color: rgba(155, 155, 155, 0.78)
    }

    .modal-close:active {
        background-color: rgb(107, 103, 103);
    }

    .my-modal-footer {
        justify-content: flex-end
    }

    .my-modal-header {
        justify-content: normal;
    }

    .title {
        font-size: x-large;
        color: #595959;
        margin: auto 20px;
        padding: 0
    }
</style>
