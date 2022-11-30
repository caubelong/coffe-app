<template>
  <div class="not-found">
    <h2>404</h2>
    <span class="border"></span>
    <p>This page coud not be found.</p>
  </div>
</template>

<script>
export default {
  name: "NotFound",
};
</script>

<style scoped>
.not-found {
  width: 100%;
  height: 500px;
  display: flex;
  justify-content: center;
  align-items: center;
}
.border {
  width: 2px;
  background: #c7c7c7;
  height: 50px;
  margin: 0 10px;
}
.not-found p {
  font-size: 18px;
}
.not-found h2,
p {
  margin-bottom: 0;
}
</style>
