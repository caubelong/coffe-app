<template>
  <EditOutlined @click="showModal"></EditOutlined>
  <div>
    <a-modal v-model:visible="visible" title="Thêm mới rule" :footer="null">
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
        :model="role"
        @finish="onFinish"
        @finishFailed="onFinishFailed"
      >
        <a-form-item
          label="Tên role"
          name="name"
          :rules="[
            { required: true, message: 'Please input your role name!' },
            { min: 3, message: 'Role name must be minimum 3 characters.' },
            { max: 15, message: 'Role name no longer than 15 characters.' },
          ]"
        >
          <a-input v-model:value="role.name" />
        </a-form-item>
        <a-form-item>
          <a-button
            class="float-end"
            :class="{ sendRequest: isPending }"
            type="primary"
            html-type="submit"
            >{{ isPending ? "Loading..." : "Update" }}</a-button
          >
        </a-form-item>
      </a-form>
    </a-modal>
  </div>
</template>

<script>
import { EditOutlined } from "@ant-design/icons-vue";
import { defineComponent, ref } from "vue";
import useRoles from "@/composables/admin/useRole";
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
  emits: ["updateRoleSuccsess"],
  setup(props, context) {
    const visible = ref(false);
    const { role, getRole, updateRole, errors, isPending } = useRoles();
    const showModal = async () => {
      await getRole(props.id);
      visible.value = true;
      errors.value = null;
    };
    const saveRoleUpdate = async () => {
      await updateRole(props.id);
      if (!errors.value) {
        context.emit("updateRoleSuccsess");
        visible.value = false;
        openNotification();
      } else {
        visible.value = true;
      }
    };
    const onFinish = async (values) => {
      console.log("Success:", values);
      await saveRoleUpdate();
    };
    const onFinishFailed = (errorInfo) => {
      console.log("Failed:", errorInfo);
    };
    const openNotification = () => {
      notification.open({
        message: "Notification",
        description: "Đã cập nhật dữ liệu mới cho role",
      });
    };
    return {
      visible,
      showModal,
      onFinish,
      onFinishFailed,
      role,
      errors,
      isPending,
    };
  },
});
</script>

<style scoped>
.sendRequest {
  opacity: 0.5;
}
</style>
