<template>
  <EditOutlined @click="showModal"></EditOutlined>
  <div>
    <a-modal v-model:visible="visible" title="Update danh mục" :footer="null">
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
import { EditOutlined } from "@ant-design/icons-vue";
import { defineComponent, ref } from "vue";
import useCategory from "@/composables/admin/useCategory";
import { notification } from "ant-design-vue";
export default defineComponent({
  name: "create-comp",
  props: {
    id: {
      type: Number,
      required: true,
    },
  },
  components: {
    EditOutlined,
  },
  emits: ["updateCategorySuccsess"],
  setup(props, context) {
    const visible = ref(false);
    const { category, getCategory, updateCategory, isPending, errors } =
      useCategory();
    const showModal = async () => {
      visible.value = true;
      errors.value = null;
      await getCategory(props.id);
    };
    const onFinish = async (values) => {
      console.log("Success:", values);
      await updateCategory(props.id);
      if (!errors.value) {
        context.emit("updateCategorySuccsess");
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
        description: "Đã cập nhật dữ liệu mới cho danh mục",
      });
    };
    return {
      visible,
      showModal,
      category,
      isPending,
      errors,
      onFinish,
      onFinishFailed,
    };
  },
});
</script>

<style scoped></style>
