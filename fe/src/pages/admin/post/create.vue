<template>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <a-card title="Thêm bài viết" style="width: 100%">
          <a-form
            enctype="multipart/form-data"
            ref="formRef"
            :model="formState"
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
              <a-input v-model:value="formState.title" />
            </a-form-item>
            <a-form-item
              label="Mô tả bài viết"
              name="desc"
              :rules="[{ required: true, message: 'Please input your desc!' }]"
            >
              <a-input v-model:value="formState.desc" />
            </a-form-item>
            <a-form-item
              name="thumbnail"
              label="Ảnh mô tả"
              v-model="formState.thumbnail"
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
              <ckEditer v-model="formState.body"></ckEditer>
            </a-form-item>
            <a-form-item
              v-model="formState.status"
              name="status"
              label="Trạng thái"
              :rules="[{ required: true, message: 'Missing area status' }]"
            >
              <a-select v-model:value="formState.status" :options="active" />
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
import { defineComponent, reactive, ref } from "vue";
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
    const formState = reactive({
      title: "",
      desc: "",
      body: "",
      thumbnail: "",
      status: "",
    });
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
    const { storePost } = usePost();
    const onFinish = async (values) => {
      console.log("Success:", values);
      await storePost({ ...formState });
      openNotification();
      resetForm();
    };
    const onFinishFailed = (errorInfo) => {
      console.log("Failed:", errorInfo);
    };
    const openNotification = () => {
      notification.open({
        message: "Notification",
        description: "Tạo mới bài viết thành công",
      });
    };
    const onChange = (e) => {
      formState.thumbnail = e.file;
    };
    const resetForm = () => {
      formRef.value.resetFields();
    };
    return {
      formState,
      active,
      onFinish,
      onFinishFailed,
      openNotification,
      formRef,
      resetForm,
      onChange,
    };
  },
});
</script>

<style scoped></style>
