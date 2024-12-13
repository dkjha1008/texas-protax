<script setup>
import { ref, watch } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { debounce } from 'lodash-es';
import axios from 'axios';

const addressInput = ref('');
const addressSuggestions = ref([]);

const fetchAddressSuggestions = debounce(async (query) => {
    if (!query) {
        addressSuggestions.value = [];
        return;
    }

    try {
        const response = await axios.get(route('details.suggestions'), {
            params: { query },
        });

        addressSuggestions.value = response.data.suggestions || [];
    } catch (error) {
        console.error('Error fetching address suggestions:', error);
    }
}, 300);

const selectAddress = async (parcel, address) => {
    try {
        const response = await axios.post(route('details.encrypt'), {
            address: address,
            parcel: parcel,
        });

        const queryParams = new URLSearchParams({
            address: response.data.data.address,
            parcel: response.data.data.parcel,
        }).toString();

        window.location.href = `/details?${queryParams}`;
    } catch (error) {
        console.error('Error processing selected address:', error);
    }
};

</script>


<template>
    <AppLayout title="Texas Protax">
        <section class="banner-bg">
            <div class="container">
                <div class="pt-5 pb-5 row banner-text">
                    <div class="col-md-12">
                        <h1>See the Average Reduction of Others Property in Your Neighborhood</h1>
                    </div>
                    <div class="p-2 mt-4 serch-section-main">
                        <div class="serch-section-inner">
                            <form>
                                <span class="input-icon">
                                    <svg width="17" height="20" viewBox="0 0 17 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M0 8.31776C0 3.71789 3.84388 0 8.49345 0C13.1561 0 17 3.71789 17 8.31776C17 10.6357 16.157 12.7876 14.7695 14.6116C13.2388 16.6235 11.3522 18.3765 9.22854 19.7524C8.74251 20.0704 8.30387 20.0944 7.77045 19.7524C5.63474 18.3765 3.74809 16.6235 2.2305 14.6116C0.841983 12.7876 0 10.6357 0 8.31776ZM5.69423 8.57675C5.69423 10.1177 6.95166 11.3297 8.49345 11.3297C10.0362 11.3297 11.3058 10.1177 11.3058 8.57675C11.3058 7.0478 10.0362 5.77683 8.49345 5.77683C6.95166 5.77683 5.69423 7.0478 5.69423 8.57675Z"
                                            fill="#C8102E" />
                                    </svg>
                                </span>
                                <input type="text" class="serch-field" placeholder="Enter Your Address"
                                    v-model="addressInput" @input="fetchAddressSuggestions($event.target.value)"
                                    aria-label="Enter Your Address">

                                <button type="submit">See Reduction</button>

                                <ul v-if="Object.keys(addressSuggestions).length > 0" class="suggestions-list">
                                    <li v-for="(address, parcel) in addressSuggestions" :key="parcel"
                                        @click="selectAddress(parcel, address)" class="suggestion-item">
                                        <div>
                                            {{ address }}
                                        </div>
                                        <div>
                                            <strong>Parcel:</strong> {{ parcel }}
                                        </div>
                                        <br>
                                    </li>
                                </ul>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>
