import {defineStore} from "pinia";

export const useAdvertisementStore = defineStore('advertisement', {
	state: () => ({
		advertisements: [],
		advertisement: {},
		isAdvertisement: false,
		params: {
			sort_field: ['price', 'created_at'],
			sort_direction: 'desc',
		}
	}),

	getters: {},

	actions: {
		async getAdvertisements(page = 1) {
			axios
			.get('/api/advertisements', {
				params: {
					page: page,
					sort_field: this.params.sort_field,
					sort_direction: this.params.sort_direction,
				}
			})
			.then(response => {
				if (response.data.data.length != 0) {
					this.advertisements = response.data
					this.isAdvertisement = true
				} else {
					this.isAdvertisement = false
				}
			})
			.catch((error) => {
				console.log(error.response.data);
			});
		},

		async getAdvertisement(advertisement) {
			axios
			.get('/api/advertisements/' + advertisement)
			.then(response => this.advertisement = response.data.data)
			.catch((error) => {
				if (error.response) {
					console.log(error.response.data);
				}
			});
		},
	}
})
