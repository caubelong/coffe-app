<template>
  <div>
    <a-button
      type="primary"
      style="float: right; margin-bottom: 10px"
      @click="showModal"
      >Thêm</a-button
    >
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
            >{{ isPending ? "Loading..." : "Thêm" }}</a-button
          >
        </a-form-item>
      </a-form>
    </a-modal>
  </div>
</template>

<script>
import { defineComponent, ref, reactive } from "vue";
import useRoles from "@/composables/admin/useRole";
import { notification } from "ant-design-vue";
export default defineComponent({
  name: "create-comp",
  emits: ["saveRoleSucess"],
  setup(props, context) {
    //show / off modal
    const visible = ref(false);
    const showModal = () => {
      visible.value = true;
      role.name = "";
      errors.value = "";
    };
    //role data
    const role = reactive({
      name: "",
    });
    //function xu ly role
    const { storeRole, isPending, errors } = useRoles();
    // add role
    const saveRole = async () => {
      await storeRole({ ...role });
      // nếu err không tồn tại ( không có lỗi ) thì thực hiện add role và đóng
      // form + hiện thông báo
      if (!errors.value) {
        context.emit("saveRoleSucess");
        role.name = "";
        visible.value = false;
        openNotification();
        // roll tồn tại ( có lỗi ) không đóng form
      } else {
        visible.value = true;
      }
    };
    // validated form, khi validated pass -> thực hiện saveRole
    const onFinish = async (values) => {
      console.log("Success:", values);
      await saveRole();
    };
    // validated không pass -> báo lỗi
    const onFinishFailed = (errorInfo) => {
      console.log("Failed:", errorInfo);
    };
    // ham tao thong bao
    const openNotification = () => {
      notification.open({
        message: "Notification",
        description: "Tạo mới role thành công",
      });
    };
    const handleOk = () => {
      visible.value = false;
    };
    return {
      visible,
      showModal,
      onFinish,
      onFinishFailed,
      role,
      saveRole,
      handleOk,
      isPending,
      errors,
    };
  },
});
</script>

<style scoped>
.sendRequest {
  opacity: 0.5;
}
</style>
