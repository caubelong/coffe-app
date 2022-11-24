<template>
  <DeleteOutlined @click="deleteCategory(idRole)"></DeleteOutlined>
</template>

<script>
import { DeleteOutlined } from "@ant-design/icons-vue";
import useCategory from "@/composables/admin/useCategory";
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
    const { removeCategory } = useCategory();
    const deleteCategory = async () => {
      if (confirm("ban co chac muon xoa danh mục nay khong ?")) {
        await removeCategory(props.idRole);
        context.emit("deleteSuccess");
        openNotification();
      }
    };
    const openNotification = () => {
      notification.open({
        message: "Notification",
        description: "Đã xóa danh mục",
      });
    };
    return {
      deleteCategory,
    };
  },
};
</script>

<style scoped></style>
