<template>
    <div class="container mx-auto my-3">
        <div class="flex justify-center">
            <div class="w-full pa-5 max-w-md bg-white rounded-lg">
                <div class="px-6 py-4">
                    <h2 class="text-2xl text-center font-semibold text-gray-700">Simple Calculator</h2>
                </div>
                <div id="calculator-form">
                    <form @submit.prevent="onSubmit" class="w-full max-w-md">
                        <div class="mb-4">
                            <label for="first-number" class="block text-gray-700">First number:</label>
                            <input v-model="form.firstNumber" type="number" id="first-number"
                                placeholder="First number here ..." class="form-input mt-1 block w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="operator" class="block text-gray-700">Operator:</label>
                            <select v-model="form.operator" id="operator" class="form-select mt-1 block w-full">
                                <option value="+">Plus (+)</option>
                                <option value="-">Minus (-)</option>
                                <option value="*">Multiplication (*)</option>
                                <option value="/">Division (/)</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="second-number" class="block text-gray-700">Second number:</label>
                            <input v-model="form.secondNumber" type="number" id="second-number"
                                placeholder="Second number here ..." class="form-input mt-1 block w-full" required>
                        </div>

                        <!-- Show results and errors -->
                        <div class="mb-4">
                            <div v-if="success" class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4"
                                role="alert">
                                <p>Result: {{ result }}</p>
                            </div>
                            <div v-else-if="message && !success"
                                class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
                                <p>{{ message }}</p>
                            </div>
                        </div>

                        <div class="mb-4">
                            <button :disabled="calculating" type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full">
                                {{ calculating ? "Getting result ..." : "Calculate Now" }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { reactive, ref } from 'vue';
import { router } from '@inertiajs/vue3';

const { result, success, expression, message } = defineProps(['result', 'expression', 'message', 'success']);

const form = reactive({
    firstNumber: 0,
    operator: '+',
    secondNumber: 0,
});

const calculating = ref(false);

const onSubmit = () => {
    calculating.value = true;

    const data = {
        firstNumber: form.firstNumber,
        operator: form.operator,
        secondNumber: form.secondNumber,
    };

    router.post('/calculator', {
        expression: `${data.firstNumber}${data.operator}${data.secondNumber}`,
    },
        {
            onFinish: () => {
                setTimeout(() => {
                    calculating.value = false;
                }, 500);
            },
        }
    );
};
</script>