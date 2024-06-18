<template>
    <h1 class="text-black text-4xl text-center">Создать объявление</h1>

    <div class="w-full h-full flex items-center justify-center">
        <div class="w-1/2">
            <form @submit.prevent="submit">
                <div class="mb-5">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Название</label>
                    <input
                        v-model="formData.name"
                        type="text" id="name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        />
                    <span class="text-red-600" v-if="errors?.name">{{ errors.name[0] }}</span>
                </div>
                <div class="mb-3">
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Описание</label>
                    <textarea
                        v-model="formData.description"
                        type="text" id="description"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        > </textarea>
                    <span class="text-red-600" v-if="errors?.description">{{ errors.description[0] }}</span>

                </div>
                <div class="mb-5">
                    <label for="price" class="block mb-2 text-sm font-medium text-gray-900 ">Цена</label>
                    <input
                        v-model="formData.price"
                        type="text" id="price"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        > </input>
                    <span class="text-red-600" v-if="errors?.price">{{ errors.price[0] }}</span>

                </div>
                <div class="mb-5">
                    <label for="images" class="block mb-2 text-sm font-medium text-gray-900 ">Описание</label>
                    <input
                        type="file"
                        id="images"
                        @change="handleFileChange"
                        accept="image/*"
                        multiple
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        >
                    <span class="text-red-600" v-if="errors?.images">{{ errors.images[0] }}</span>
                </div>
                <button
                    type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Создать объявление
                </button>
            </form>
        </div>
    </div>
</template>

<script>
import {toRaw} from "vue";
import { useRouter } from 'vue-router';

export default {

    data() {
        return {
            formData: {
                name: '',
                description: '',
                price: '',
                images: [],
            },
            errors: {}
        }
    },

    methods: {
        handleFileChange(e) {
            var files = e.target.files || e.dataTransfer.files;

            if (!files.length)
                return;

            for (let file of files) {
                let name = 'storage/' + file?.name;
                this.formData.images.push(name);
            }
        },

        submit () {
            let data = new FormData();
            data.append("name", this.formData.name);
            data.append("description", this.formData.description);
            data.append("price", this.formData.price);
            data.append("images[]", toRaw(this.formData.images));

            axios.post('/api/advertisements', data)
            .then(function (response)  {
            })
            .catch(error => {
                if (error.response) {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors
                    }
                }
            })
        }
    }
}
</script>
