<template>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <a-page-header
          style="border: 1px solid rgb(235, 237, 240)"
          title="Quay lại"
          sub-title="/ update bài viết"
          @back="() => null"
        />
        <a-card style="width: 100%">
          <a-form
            enctype="multipart/form-data"
            ref="formRef"
            :model="postInfo"
            name="basic"
            :label-col="{ span: 4 }"
            :wrapper-col="{ span: 10 }"
            @finish="onFinish"
            @finishFailed="onFinishFailed"
          >
            <a-form-item
              label="Tiêu đề"
              name="title"
              :rules="[{ required: true, message: 'Please input your title!' }]"
            >
              <a-input v-model:value="postInfo.title" />
            </a-form-item>
            <a-form-item
              label="Mô tả bài viết"
              name="desc"
              :rules="[{ required: true, message: 'Please input your desc!' }]"
            >
              <a-input v-model:value="postInfo.desc" />
            </a-form-item>
            <a-form-item label="Ảnh mô tả sản phẩm">
              <a-image
                :width="100"
                :src="postInfo.thumbnail"
                :alt="postInfo.title"
              />
            </a-form-item>
            <a-form-item
              name="thumbnail"
              label="Ảnh mô tả"
              v-model="postInfo.thumbnail"
            >
              <!--su dung before upload de chan auto tai len-->
              <a-upload
                @change="onChange"
                :before-upload="
                  () => {
                    return false;
                  }
                "
                name="thumbnail"
                list-type="picture"
              >
                <a-button>
                  <upload-outlined></upload-outlined>
                  Click to Upload
                </a-button>
              </a-upload>
            </a-form-item>
            <a-form-item label="Nội dung" name="body">
              <ckEditer v-model="postInfo.body"></ckEditer>
            </a-form-item>
            <a-form-item
              name="status"
              label="Trạng thái"
              :rules="[{ required: true, message: 'Missing area' }]"
            >
              <select
                class="form-select form-select-sm"
                v-model="postInfo.status"
              >
                <option
                  style="border-radius: 5px"
                  v-for="(status, index) in active"
                  :key="index"
                  :value="status.value"
                >
                  {{ status.label }}
                </option>
              </select>
            </a-form-item>
            <a-form-item :wrapper-col="{ offset: 4, span: 16 }">
              <a-button type="primary" html-type="submit">Thêm</a-button>
              <a-button style="margin-left: 10px" @click="resetForm"
                >Reset</a-button
              >
            </a-form-item>
          </a-form>
        </a-card>
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent, ref, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";
import { notification } from "ant-design-vue";
import { UploadOutlined } from "@ant-design/icons-vue";
import usePost from "@/composables/admin/usePost";
import ckEditer from "@/components/admin/ckEditer";
export default defineComponent({
  name: "create-comp",
  components: {
    UploadOutlined,
    ckEditer,
  },
  setup() {
    const active = [
      {
        label: "Hoạt động",
        value: "1",
      },
      {
        label: "Tạm dừng hoạt động",
        value: "0",
      },
    ];
    const formRef = ref();
    const router = useRoute();
    const route = useRouter();
    const id = router.params.id;
    const { getPost, postInfo, updatePost } = usePost();
    onMounted(() => {
      getPost(id);
    });
    const onFinish = async (values) => {
      updatePost(id);
      console.log("Success:", values);
      setTimeout(() => {
        route.push({ name: "admin-post" });
      }, 0.3);
      openNotification();
      resetForm();
    };
    const onFinishFailed = (errorInfo) => {
      console.log("Failed:", errorInfo);
    };
    const openNotification = () => {
      notification.open({
        message: "Notification",
        description: "Update bài viết thành công",
      });
    };
    const onChange = (e) => {
      if (e.file) {
        postInfo.value.thumbnail = e.file;
      } else {
        postInfo.value.thumbnail = "";
      }
      console.log(e);
    };
    const resetForm = () => {
      formRef.value.resetFields();
    };
    return {
      active,
      onFinish,
      onFinishFailed,
      openNotification,
      formRef,
      resetForm,
      onChange,
      postInfo,
    };
  },
});
</script>

<style scoped></style>
