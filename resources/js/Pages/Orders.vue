<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import axios from 'axios';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const errors = ref([]);

const form = useForm({
    amount: '',
    buyer: '',
    receipt_id: '',
    items: '',
    buyer_email: '',
    note: '',
    city: '',
    phone: '',
});


async function storeOrder(){
    await axios.post('/orders/store', form)
    .then(function (response) {
        console.log(response.data);
        console.log(response.data);
        if(response.data.errors){
            errors.value = response.data.errors;
        }else{
            errors.value = {};
        }
    })
    .catch(function (error) {
        console.log(error);
    });
}

</script>

<template>
    <AuthenticatedLayout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Create Order</h2>

            <p class="mt-1 text-sm text-gray-600">
                Add the following information to create an Order.
            </p>
        </header>

        <form @submit.prevent class="mt-6 space-y-6">
        <!-- <form @submit.prevent="form.post(route('orders.store'))" class="mt-6 space-y-6"> -->

            <div>
                <InputLabel for="amount" value="Amount" />

                <TextInput
                    id="amount"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.amount"
                    required
                />

                <InputError class="mt-2" v-if="errors.amount" :message="errors.amount[0]" />
            </div>

            <div>
                <InputLabel for="buyer" value="Buyer" />
                <TextInput
                    id="buyer"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.buyer"
                    required
                />
                <InputError class="mt-2" v-if="errors.buyer" :message="errors.buyer[0]" />
            </div>

            <div>
                <InputLabel for="receipt_id" value="Receipt_id" />
                <TextInput
                    id="receipt_id"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.receipt_id"
                    required
                />
                <InputError class="mt-2" v-if="errors.receipt_id" :message="errors.receipt_id[0]" />
            </div>
            
            <div>
                <InputLabel for="items" value="Items" />
                <TextInput
                    id="items"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.items"
                    required
                />
                <InputError class="mt-2" v-if="errors.items" :message="errors.items[0]" />
            </div>

            <div>
                <InputLabel for="buyer_email" value="Buyer_email" />
                <TextInput
                    id="buyer_email"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.buyer_email"
                    required
                />
                <InputError class="mt-2" v-if="errors.buyer_email" :message="errors.buyer_email[0]" />
            </div>
            
            <div>
                <InputLabel for="note" value="Note" />
                <TextInput
                    id="note"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.note"
                    required
                />
                <InputError class="mt-2" v-if="errors.note" :message="errors.note[0]" />
            </div>

            <div>
                <InputLabel for="city" value="City" />
                <TextInput
                    id="city"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.city"
                    required
                />
                <InputError class="mt-2" v-if="errors.city" :message="errors.city[0]" />
            </div>

            <div>
                <InputLabel for="phone" value="Phone" />
                <TextInput
                    id="phone"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.phone"
                    required
                />
                <InputError class="mt-2" v-if="errors.phone" :message="errors.phone[0]" />
            </div>


            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing" @click="storeOrder">Save</PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                </Transition>
            </div>
        </form>
        
    </section>
    

        </div>
    </div>

    </AuthenticatedLayout>
</template>