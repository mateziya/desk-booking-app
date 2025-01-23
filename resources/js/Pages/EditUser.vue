<script setup>
import Container from '../Components/Container.vue';
import Title from '../Components/Title.vue';
import InputField from '../Components/InputField.vue';
import PrimaryBtn from '../Components/PrimaryBtn.vue';
import ErrorMessages from '../Components/ErrorMessages.vue';
import RoleSelect from '../Components/RoleSelect.vue';

import { useForm } from '@inertiajs/vue3';

const props = defineProps({
  user: Object,
});

const form = useForm({
  name: props.user.name,
  email: props.user.email,
  role: props.user.role
});

const submit = () => {
  form.patch(route('users.update', props.user.id));
};
</script>

<template>
  <Container class="mt-8 max-w-sm sm:max-w-md sm:mt-10 lg:mt-14">
    <img class="my-4 h-20 w-auto mx-auto" src="../Images/Icon.png" alt="App Logo">
    <div class="mb-8 text-center">
      <Title class="mt-6">Edit User details</Title>
    </div>

    <ErrorMessages :errors="form.errors" />

    <form @submit.prevent="submit" class="space-y-6">
      <InputField label="Name" icon="user" v-model="form.name" />
      <InputField label="Email" icon="envelope" v-model="form.email" />
      <RoleSelect label="Role" icon="ticket" v-model="form.role"/>
      <PrimaryBtn :disabled="form.processing">Update User</PrimaryBtn>
    </form>
  </Container>
</template>