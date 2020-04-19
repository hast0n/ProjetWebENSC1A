<template>
    <div>
        <div class="page-info" @click="showInfos = true">
            <p>?</p>
        </div>

        <modal v-if="showInfos" @close="showInfos = false" :okBtn="true" :closeBtn="false" title="Besoin d'aide ?">
            <div class="info-content">
                <slot></slot>
            </div>
        </modal>
    </div>
</template>

<script>
    export default {
        name: "info-modal",
        data() {
            return {
                showInfos: false
            }
        }
    }
</script>

<style scoped>
    .page-info {
        position: fixed;
        bottom: 10px;
        right: 10px;
        width: 70px;
        height: 70px;
        border: 3px solid white;
        border-radius: 100%;
        background: linear-gradient(120deg, rgba(247, 101, 0, 0.93), rgb(255, 46, 46), rgba(222, 0, 93, 0.9));;
        box-shadow: rgba(0,0,0,0.2) 4px 4px 14px;
        cursor: pointer;
        color: white;
        font-size: 3.1rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .page-info:hover {
        background: linear-gradient(120deg, rgba(242, 101, 0, 0.93), rgb(241, 44, 44), rgba(213, 0, 93, 0.9));;
    }

    .page-info > p {
        margin: 0 !important;
    }

    .info-content {
        padding: 20px
    }
</style>
