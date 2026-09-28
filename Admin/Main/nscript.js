tinymce.init({
  selector: "textarea",
  plugins: "lists advlist autolink autoresize charmap code emoticons hr image insertdatetime link media paste preview searchreplace table textpattern toc visualblocks visualchars wordcount quickbars",
  toolbar: "code preview | undo redo | formatselect | fontselect | fontsizeselect | bold italic underline strikethrough backcolor | subscript superscript | numlist bullist | alignleft aligncenter alignright alignjustify | outdent indent | paste searchreplace | toc link image media charmap insertdatetime emoticons hr | table tabledelete | tableprops tablerowprops tablecellprops | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol | removeformat",
  insertdatetime_element: true,
   media_scripts: [
   {filter: 'platform.twitter.com'},
   {filter: 's.imgur.com'},
   {filter: 'instagram.com'},
   {filter: 'https://platform.twitter.com/widgets.js'},
 ],
   browser_spellcheck: true,
   contextmenu: false,
});