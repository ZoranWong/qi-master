let agreeTemplate = '<div><input type="number" name = "amount"></div>';
console.log(agreeTemplate);
$(document).off('click', '.withdraw-agree');
$(document).on('click', '.withdraw-agree', function () {
swal({
title: '同意提现',
html: agreeTemplate,
button: {
text: '同意'
}
}).then((data) => {
console.log(data);
});
});
