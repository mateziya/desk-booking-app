<script setup>
const model = defineModel();

defineProps({
  name: String
})
</script>

<template>
  <div class="flex items-center gap-2">
    <input 
      type="checkbox" 
      v-model="model" 
      :id="name" 
      class="col-start-1 row-start-1 appearance-none rounded border border-slate-500 bg-white/5 checked:border-indigo-600 checked:bg-indigo-600 indeterminate:border-indigo-600 indeterminate:bg-indigo-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-slate-400 disabled:bg-slate-400 disabled:checked:bg-slate-400 forced-colors:appearance-auto">
      <label 
        :for="name"
        class="block text-sm font-medium text-slate-400 cursor-pointer">
        <slot />
      </label>
  </div>
</template>