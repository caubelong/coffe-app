<template>
  <editor :api-key="apiKey" :init="init" />
</template>

<script>
import Editor from "@tinymce/tinymce-vue";
export default {
  name: "ckEditer",
  components: {
    Editor,
  },
  setup() {
    const apiKey = "fifjc9rr8z800stijt5dlgl185grxeplz9mwj75ajuau4s51";
    const init = {
      selector: "textarea#file-picker",
      plugins: "image code",
      height: "500",
      toolbar:
        "code |image |undo redo | formatselect| bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table",
      image_title: true,
      automatic_uploads: true,
      file_picker_types: "image",
      file_picker_callback: function (cb, value, meta) {
        var input = document.createElement("input");
        input.setAttribute("type", "file");
        input.setAttribute("accept", "image/*");
        input.onchange = function () {
          var file = this.files[0];

          var reader = new FileReader();
          reader.onload = function () {
            var id = "blobid" + new Date().getTime();
            var blobCache = tinymce.activeEditor.editorUpload.blobCache;
            var base64 = reader.result.split(",")[1];
            var blobInfo = blobCache.create(id, file, base64);
            blobCache.add(blobInfo);
            cb(blobInfo.blobUri(), { title: file.name });
          };
          reader.readAsDataURL(file);
        };

        input.click();
      },
      content_style:
        "body { font-family:Helvetica,Arial,sans-serif; font-size:14px }",
    };
    return {
      apiKey,
      init,
    };
  },
};
</script>

<style scoped></style>
