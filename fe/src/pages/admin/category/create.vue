<template>
  <div>
    <a-button
      type="primary"
      style="float: right; margin-bottom: 10px"
      @click="showModal"
      >Thêm</a-button
    >
    <a-modal v-model:visible="visible" :footer="null" title="Thêm mới danh mục">
      <div class="mb-3" v-for="(error, index) in errors" :key="index">
        <a-alert
          :closable="true"
          v-for="err in error"
          :key="err"
          :message="err"
          type="error"
          show-icon
        />
      </div>
      <a-form
        ref="formRef"
        :model="category"
        @finish="onFinish"
        @finishFailed="onFinishFailed"
      >
        <a-form-item
          label="Tên danh mục"
          name="name"
          :rules="[
            { required: true, message: 'Please input your category name!' },
            { min: 3, message: 'category name must be minimum 3 characters.' },
            { max: 20, message: 'category name no longer than 15 characters.' },
          ]"
        >
          <a-input v-model:value="category.name" />
        </a-form-item>
        <a-form-item>
          <a-button
            class="float-end"
            :class="{ sendRequest: isPending }"
            type="primary"
            html-type="submit"
            >{{ isPending ? "Loading..." : "Thêm" }}</a-button
          >
        </a-form-item>
      </a-form>
    </a-modal>
  </div>
</template>

<script>
import { defineComponent, ref, reactive } from "vue";
import useCategory from "@/composables/admin/useCategory";
import { notification } from "ant-design-vue";
export default defineComponent({
  name: "create-comp",
  emits: ["saveCategorySuccsess"],
  setup(props, context) {
    //show / off modal
    const visible = ref(false);
    const showModal = () => {
      visible.value = true;
    };
    //add roles
    const category = reactive({
      name: "",
    });
    const { storeCategory, errors, isPending } = useCategory();
    const onFinish = async (values) => {
      console.log("Success:", values);
      await storeCategory({ ...category });
      if (!errors.value) {
        context.emit("saveCategorySuccsess");
        category.name = "";
        openNotification();
        visible.value = false;
      } else {
        visible.value = true;
      }
    };
    const onFinishFailed = (errorInfo) => {
      console.log("Failed:", errorInfo);
    };
    const openNotification = () => {
      notification.open({
        message: "Notification",
        description: "Tạo mới role thành công",
      });
    };
    return {
      visible,
      showModal,
      category,
      errors,
      isPending,
      onFinish,
      onFinishFailed,
    };
  },
});
</script>

<style scoped></style>
