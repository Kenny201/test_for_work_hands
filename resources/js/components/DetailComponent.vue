<template>
    <h1 class="text-black text-4xl text-center"> {{ advertisement.name }}</h1>

    <div v-for="image in advertisement.images">
        <img :src="image">
    </div>

    <div class="flex-col flex">
        <span> Цена: {{ advertisement.price }} </span>
    </div>
</template>

<script>
import {mapActions, mapState} from "pinia";
import {useAdvertisementStore} from "../stores/advertisement.js";

export default {
    data() {
        return {}
    },
    computed: {
        ...mapState(useAdvertisementStore, ["advertisement"]),
    },
    methods: {
        ...mapActions(useAdvertisementStore, ['getAdvertisement'])
    },
    mounted() {
        this.getAdvertisement(this.$route.params.advertisement);
    }
}
</script>
