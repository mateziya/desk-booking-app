<script setup>
const model = defineModel();

defineProps({
  label: String,
  icon: String
});

</script>

<template>
  <div>
    <form @change="submit">
      <label :for="label" class="block text-sm font-semibold text-slate-400">
      {{ label }}
      </label>
      <div class="relative mt-1 rounded-md">
        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
        <span class="grid place-content-center text-sm text-slate-400">
          <i :class="`fa-solid fa-${icon}`"></i>
        </span>
      </div>
      <select :name="label" v-model="model" class="block w-full rounded-2xl pr-3 pl-9 text-sm font-semibold text-slate-400 bg-white/5 border-slate-500 outline-0 focus:ring-1 focus:ring-inset focus:ring-indigo-400 focus:border-indigo-400">
        <option value="admin">Admin</option>
        <option value="user">User</option>
      </select>
      </div>
    </form>
  </div>
</template>

