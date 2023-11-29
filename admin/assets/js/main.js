$.noConflict();

jQuery(document).ready(function ($) {

	"use strict";

	[].slice.call(document.querySelectorAll('select.cs-select')).forEach(function (el) {
		new SelectFx(el);
	});

	jQuery('.selectpicker').selectpicker;


	$('#menuToggle').on('click', function (event) {
		$('body').toggleClass('open');
	});

	$('.search-trigger').on('click', function (event) {
		event.preventDefault();
		event.stopPropagation();
		$('.search-trigger').parent('.header-left').addClass('open');
	});

	$('.search-close').on('click', function (event) {
		event.preventDefault();
		event.stopPropagation();
		$('.search-trigger').parent('.header-left').removeClass('open');
	});

	// $('.user-area> a').on('click', function(event) {
	// 	event.preventDefault();
	// 	event.stopPropagation();
	// 	$('.user-menu').parent().removeClass('open');
	// 	$('.user-menu').parent().toggleClass('open');
	// });
});
//Cài này là giải thích thứ tự danh mục
function showSuggestions() {
	var inputValue = document.getElementById('inputField').value;
	var suggestionList = document.getElementById('suggestionList');
	suggestionList.innerHTML = '<li>(0) -> Ẩn danh mục</li><li>(1, 2,...) -> Tương ứng thứ tự</li>';
}

// Đoạn mã JavaScript để tự động focus vào input khi trang được tải
document.addEventListener("DOMContentLoaded", function () {
	document.getElementById("firstInput").focus();
});