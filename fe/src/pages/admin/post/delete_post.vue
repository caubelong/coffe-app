<template>
  <a-popconfirm
    title="Bạn có chắc muốn xóa bài viết này không ?"
    cancel-text="No"
    ok-text="Yes"
    @confirm="confirm"
    @cancel="cancel"
  >
    <DeleteOutlined></DeleteOutlined>
  </a-popconfirm>
</template>

<script>
import { DeleteOutlined } from "@ant-design/icons-vue";
import { defineComponent } from "vue";
import { message } from "ant-design-vue";
import usePost from "@/composables/admin/usePost";
export default defineComponent({
  components: {
    DeleteOutlined,
  },
  props: {
    id: {
      type: Number,
      required: true,
    },
  },
  emits: ["deleteSuccess"],
  setup(props, context) {
    const { removePost } = usePost();
    const confirm = async () => {
      await removePost(props.id);
      message.success("Xóa bài viết thành công");
      context.emit("deleteSuccess");
    };

    const cancel = () => {
      return;
    };

    return {
      confirm,
      cancel,
    };
  },
});
</script>
<style scoped></style>
