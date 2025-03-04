<script setup>
import { ref, onMounted } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    address: String,
    satelliteImageUrl: String,
    averageReductionPercent: Number,
    finalValue: Number,
    taxRate: Number,
    parcel: String,
    potentialReduction: Object,
    potentialSavings: Object,
    hashCode: String,
});

const formattedPrice = (price) => {
    return new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(price);
}

const handleContinueClick = (hashCode) => {
    console.log(hashCode);
    const url = `https://customerportal.texasprotax.com/Neighborhood/${hashCode}`;
    window.location.href = url;
}

</script>

<template>
    <AppLayout title="Texas Protax">
        <div class="container">
            <div class="p-4 mt-5 mb-5 row for-saving g-4">
                <div class="col-md-6 right-img">
                    <!-- Display satellite image -->
                    <img :src="satelliteImageUrl" alt="Satellite Image" class="img-fluid" />

                </div>
                <div class="col-md-6 ps-5 right-section">
                    <h6 style="display: flex; align-items: center; gap: 8px;">
                        <svg width="17" height="20" viewBox="0 0 17 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M0 8.31776C0 3.71789 3.84388 0 8.49345 0C13.1561 0 17 3.71789 17 8.31776C17 10.6357 16.157 12.7876 14.7695 14.6116C13.2388 16.6235 11.3522 18.3765 9.22854 19.7524C8.74251 20.0704 8.30387 20.0944 7.77045 19.7524C5.63474 18.3765 3.74809 16.6235 2.2305 14.6116C0.841983 12.7876 0 10.6357 0 8.31776ZM5.69423 8.57675C5.69423 10.1177 6.95166 11.3297 8.49345 11.3297C10.0362 11.3297 11.3058 10.1177 11.3058 8.57675C11.3058 7.0478 10.0362 5.77683 8.49345 5.77683C6.95166 5.77683 5.69423 7.0478 5.69423 8.57675Z"
                                fill="#130F26" />
                        </svg>
                        {{ address }}
                    </h6>
                    <div class="reduction-sec">
                        <h5>Potential Reduction</h5>
                        <h3>{{ formattedPrice(potentialReduction) }}</h3>
                    </div>
                    <div class="reduction-sec">
                        <h5>Potential Savings</h5>
                        <h3>{{ formattedPrice(potentialSavings) }}</h3>
                    </div>
                    <div class="reduction-sec">
                        <h5>Tax Rate</h5>
                        <h3>{{ taxRate }}%</h3>
                    </div>


                </div>
                <div>
                    <p>
                        <b>Disclaimer:</b>

                        This estimate is based on our historical performance for the 2024 tax year within your
                        neighborhood or, when neighborhood-specific data is statistically insufficient, within the
                        broader market area.
                    </p>

                    <p>The projected tax savings are calculated using a hypothetical 2% tax rate.</p>

                    <p>Actual savings may vary due to numerous factors, including jurisdictional differences,
                        exemptions, property condition, and other variables affecting property tax protests.</p>

                    <p>This map is intended for estimation purposes only and should not be relied upon as a guarantee of
                        future results.</p>
                </div>
            </div>
            <div class="row">
                <div class="text-center col-md-12">
                    <button class="c-btn" @click="handleContinueClick(hashCode)">Continue</button>
                </div>
            </div>

            <div class="mt-5 mb-5 row">
                <div class="text-center col-md-12 started-text">
                    <h2>Getting started is easy</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="started-box">
                        <h5>What you do</h5>
                        <ol class="custom-list">
                            <li>Enter your property address</li>
                            <li>View your potential tax savings</li>
                            <li>Provide your contact details</li>
                            <li>Authorize us as your property tax agent</li>
                            <li>Answer a few brief questions</li>
                        </ol>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="started-box">
                        <h5>What you do</h5>
                        <ol class="custom-list for-color-chngr">
                            <li>Evaluate your property</li>
                            <li>Assemble protest evidence and materials</li>
                            <li>Complete and file all necessary paperwork</li>
                            <li>Work with the county on your behalf</li>
                            <li>Monitor your property to maximize savings in the future</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="mt-5 mb-5 row">
                <div class="text-center col-md-12">
                    <button class="c-btn">Get Started</button>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
