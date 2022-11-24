<template>
  <a-popconfirm
    title="Bạn có chắc muốn xóa role này không ?"
    cancel-text="No"
    ok-text="Yes"
    @confirm="deleteRole"
    @cancel="cancel"
  >
    <DeleteOutlined></DeleteOutlined>
  </a-popconfirm>
</template>

<script>
import { DeleteOutlined } from "@ant-design/icons-vue";
import useRoles from "@/composables/admin/useRole";
import { notification } from "ant-design-vue";
export default {
  name: "delete-comp",
  emits: ["deleteSuccess"],
  components: {
    DeleteOutlined,
  },
  props: ["idRole"],
  setup(props, context) {
    //delete role
    const { removeRole } = useRoles();
    const deleteRole = async () => {
      await removeRole(props.idRole);
      context.emit("deleteSuccess");
      openNotification();
    };
    const cancel = () => {
      return;
    };
    const openNotification = () => {
      notification.open({
        message: "Notification",
        description: "Đã xóa role",
      });
    };
    return {
      deleteRole,
      cancel,
    };
  },
};
</script>

<style scoped></style>
