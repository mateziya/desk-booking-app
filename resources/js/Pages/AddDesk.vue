<script setup>
import Container from '../Components/Container.vue';
import Title from '../Components/Title.vue';
import InputField from '../Components/InputField.vue';
import PrimaryBtn from '../Components/PrimaryBtn.vue';
import ErrorMessages from '../Components/ErrorMessages.vue';
import ImageUpload from '../Components/ImageUpload.vue';

import { useForm } from '@inertiajs/vue3';

const form = useForm({
  name: '',
  image: ''
});

const submit = () => {
  form.post(route('desks.create'));
};
</script>

<template>
  <Container class="mt-8 max-w-sm sm:max-w-md sm:mt-10 lg:mt-14">
    <img class="my-4 h-20 w-auto mx-auto" src="../Images/Icon.png" alt="App Logo">
    <div class="mb-8 text-center">
      <Title class="mt-6">Set up a new Desk</Title>
    </div>

    <ErrorMessages :errors="form.errors" />

    <form @submit.prevent="submit" class="space-y-6">
      <InputField label="Name" icon="display" v-model="form.name" />
      <ImageUpload @image="(e) => (form.image = e)"/>

      <PrimaryBtn :disabled="form.processing">Create Desk</PrimaryBtn>
    </form>
  </Container>
</template>