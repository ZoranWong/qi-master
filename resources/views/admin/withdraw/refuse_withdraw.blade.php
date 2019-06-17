let refuseTemplate = ``;
$(document).off('click', '.withdraw-refuse');
$(document).on('click', '.withdraw-refuse', function () {
swal({
title: '同意提现',
text: '',
content: refuseTemplate,
button: {
text: '同意'
}
}).then((data) => {
console.log(data);
});
});
