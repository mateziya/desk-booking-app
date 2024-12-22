<script setup>

</script>

<template>
  <button class="flex 
                w-full
                justify-center 
                rounded-2xl 
                bg-indigo-600 
                px-3 
                py-1.5 
                text-sm/6 
                font-semibold 
                text-white 
                shadow-sm 
                hover:bg-indigo-700 
                focus-visible:outline 
                focus-visible:outline-2 
                focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
    <slot/>
  </button>
</template>