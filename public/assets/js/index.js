// // const { ajax } = require("jquery");

// // $('#province_id').change(function () {
// //     var cid = $(this).val();
// //     // console.log(cid);
// //     if (cid) {

// //         $.ajax({
// //             type: "get",
// //             url: "{{url('admin/getDistricts/')}}?id=" + cid,
// //             // datatype: JSON,
// //             success: function (res) {
// //                 if (res) {
// //                     console.log(res);
// //                     $("#district_id").empty();
// //                     $("#district_id").append('<option>Select District</option>');
// //                     $.each(res, function (key, value) {
// //                         $("#district_id").append('<option value="' + key + '">' + value + '</option>');
// //                     });
// //                 }
// //             else{
// //                 $("#district_id").empty();
// //             }
// //         }
// //     })
// // }
// //     else {
// //         $("#district_id").empty();
// //     }
// // });
// $(document).ready(function() {
//     $('#province_id').change(function() {
//         var countryID = $(this).val();
//         // let _url = "{{ url('/admin/getDistricts') }}/" + countryID;
//         let _url = "../getDistricts/" + countryID;
//         console.log(_url);

//         // "admin/getDistricts/" + countryID
//         if (countryID) {
//             $.ajax({
//                 type: "GET",
//                 url: _url,
//                 success: function(response) {
//                     console.log(response);
//                     if (response) {
//                         $("#district_id").empty();
//                         $("#district_id").append('<option>Select</option>');
//                         $.each(response, function(key, value) {
//                             $("#district_id").append('<option value="' +
//                                 value['code'] + '">' + value[
//                                 'fullname'] + '</option>');
//                         });

//                     } else {
//                         $("#district_id").empty();
//                     }
//                 }
//             });
//         } else {
//             $("#district_id").empty();
//         }
//     });

// });
// $(document).ready(function() {
//     $('#province_id').change(function() {
//         var countryID = $(this).val();
//         // let _url = "{{ url('/admin/getDistricts') }}/" + countryID;
//         let _url = "../../getDistricts/" + countryID;
//         console.log(_url);

//         // "admin/getDistricts/" + countryID
//         if (countryID) {
//             $.ajax({
//                 type: "GET",
//                 url: _url,
//                 success: function(response) {
//                     console.log(response);
//                     if (response) {
//                         $("#district_id").empty();
//                         $("#district_id").append('<option>Select</option>');
//                         $.each(response, function(key, value) {
//                             $("#district_id").append('<option value="' +
//                                 value['code'] + '">' + value[
//                                 'fullname'] + '</option>');
//                         });

//                     } else {
//                         $("#district_id").empty();
//                     }
//                 }
//             });
//         } else {
//             $("#district_id").empty();
//         }
//     });

// });
