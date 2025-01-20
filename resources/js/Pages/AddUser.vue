<script setup>
import Container from '../Components/Container.vue';
import Title from '../Components/Title.vue';
import InputField from '../Components/InputField.vue';
import PrimaryBtn from '../Components/PrimaryBtn.vue';
import ErrorMessages from '../Components/ErrorMessages.vue';
import RoleSelect from '../Components/RoleSelect.vue';

import { useForm } from '@inertiajs/vue3';

const form = useForm({
  name: '',
  email: '',
  role: '',
  password: '',
  password_confirmation: ''
});

const submit = () => {
  form.post(route('admin.create'), {
    onFinish: () => form.reset('password', 'password_confirmation')
  });
};
</script>

<template>
  <Container class="mt-14 lg:max-w-md md:max-w-md">
    <img class="my-4 h-20 w-auto mx-auto" src="../Images/Icon.png" alt="App Logo">
    <div class="mb-8 text-center">
      <Title class="mt-6">Set up a new User</Title>
    </div>

    <ErrorMessages :errors="form.errors" />

    <form @submit.prevent="submit" class="space-y-6">
      <InputField label="Name" icon="user" v-model="form.name" />
      <InputField label="Email" icon="envelope" v-model="form.email" /> 
      <RoleSelect label="Role" icon="ticket" v-model="form.role"/>
      <InputField label="Password" type="password" icon="lock" v-model="form.password" />
      <InputField label="Confirm Password" type="password" icon="lock" v-model="form.password_confirmation" />

      <PrimaryBtn :disabled="form.processing">Create User</PrimaryBtn>
    </form>
  </Container>
</template>