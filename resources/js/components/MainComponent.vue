<template>
    <div class="flex justify-center ">
        <router-link
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            :to="{ name: 'CreateComponent' }">Создать объявление
        </router-link>
    </div>

    <div v-if="isAdvertisement" class="mt-5 flex justify-center">
      <a href="#"
         class="text-white mr-2 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
         @click.prevent="change_sort('created_at')">
        Отсортировать по дате создания
        <span v-if="this.params.sort_field.includes('created_at') && this.params.sort_direction == 'asc'">&uarr;</span>
        <span v-if="this.params.sort_field.includes('created_at') && this.params.sort_direction == 'desc'">&darr;</span>
      </a>

      <a href="#"

         class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
         @click.prevent="change_sort('price')">
        Отсортировать по цене
        <span v-if="this.params.sort_field.includes('price') && this.params.sort_direction == 'asc'">&uarr;</span>
        <span v-if="this.params.sort_field.includes('price') && this.params.sort_direction == 'desc'">&darr;</span>
      </a>
    </div>

    <div class="mt-16 grid grid-cols-3 gap-4">
        <div v-for="advertisement in advertisements.data">
            <div class="mb-5">
                <img :src="advertisement.image">
            </div>

            <div class="flex-col flex mb-5">
                <span> Название: {{ advertisement.name }} </span>
                <span> Цена: {{ advertisement.price }} </span>
            </div>

            <router-link
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                :to="{ name: 'DetailComponent', params: { advertisement: advertisement.id } }">Посмотреть объявление
            </router-link>
        </div>
    </div>
    <TailwindPagination :data="advertisements" @pagination-change-page="getAdvertisements" class="mt-4"/>
</template>

<script>
import {useAdvertisementStore} from "../stores/advertisement.js";
import {mapActions, mapState} from "pinia";
import {TailwindPagination} from "laravel-vue-pagination";

export default {
    components: {TailwindPagination},
    data() {
    },
    watch: {
        params: {
            handler() {
                this.getAdvertisements(this.$route.params.page);
            },
            deep: true
        },
    },
    computed: {
        ...mapState(useAdvertisementStore, ["advertisements", 'params', 'isAdvertisement']),
    },
    methods: {
        ...mapActions(useAdvertisementStore, ['getAdvertisements']),

        change_sort(field) {
            if (this.params.sort_field === field) {
                this.params.sort_direction = this.params.sort_direction === 'asc' ? 'desc' : 'asc';
            } else {
                this.params.sort_field = field;
                this.params.sort_direction = 'asc';
            }
        },
    },
    mounted() {
        this.getAdvertisements(this.$route.params.page, this.params.sort_field, this.params.sort_direction);
    }
}
</script>
