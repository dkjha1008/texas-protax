<script setup>
import { ref, watch } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { debounce } from 'lodash-es';
import axios from 'axios';

const addressInput = ref('');
const addressSuggestions = ref([]);
const satelliteImageUrl = ref('');

// Function to fetch suggestions from the backend
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
    addressInput.value = address; // Update input with selected address

    try {
        // Use the raw value of addressInput
        const response = await axios.post(route('details.index'), {
            addressInput: addressInput.value, // Pass only the value
        });

        // Redirect with query params
        const queryParams = new URLSearchParams({
            address: address,
            lat: response.data.data.coordinates.lat,
            lng: response.data.data.coordinates.lng,
        }).toString();

        // Uncomment if redirection is needed
        // window.location.href = `/detailss?${queryParams}`;
    } catch (error) {
        console.error('Error processing selected address:', error);
    }
};

</script>


<template>
    <AppLayout title="Texas Protax">
        <div>
            <h1 class="text-center">Welcome to Inertia.js with Vue 3</h1>

            <!-- Address Input Field -->
            <!-- Address Input Field -->
            <input type="text" v-model="addressInput" @input="fetchAddressSuggestions($event.target.value)"
                class="form-control" placeholder="Enter your address" />

            <!-- Suggestions Dropdown -->
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
            <!-- Display Satellite Image -->
            <div v-if="satelliteImageUrl" class="mt-4">
                <h3>Satellite Image</h3>
                <img :src="satelliteImageUrl" alt="Satellite View" class="img-fluid" />
            </div>
        </div>
    </AppLayout>
</template>
