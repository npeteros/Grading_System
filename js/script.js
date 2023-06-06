const buttons = [
    ["#addClass", addClass],
    ["#dissolveClass", dissolveClass],
    ["#modifyClass", modifyClass],
    ["#addStudent", addStudent],
    ["#dropStudent", dropStudent],
    ["#modifyStudent", modifyStudent],
    ["#addExam", addExam],
    ["#removeExam", removeExam],
    ["#modifyExam", modifyExam],
    ["#addEntry", addEntry],
    ["#removeEntry", removeEntry],
    ["#modifyEntry", modifyEntry],
    ["#importClass", importClass]
];

$(document).on("submit", "#import-class", function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    ajax_importClass(formData);
});

var classrooms = Array();
var schedules = Array();
var campuses = Array();
var courses = Array();

function addClass() {
    $("#output").text("");
    $("#btnList").hide();
    $("#generatedForm").html("");
    var str = "";
    str += "<label for='group'>Group Number</label><input type='number' id='groupNum' class='new_forms' min=1 required>";
    str += "<label for='code'>Course Code</label><input type='text' id='courseCode' class='new_forms' maxlength='30' required>";
    str += "<label for='s_time'>Start Time</label><input type='time' id='s_time' class='new_forms' required>";
    str += "<label for='e_time'>End Time</label><input type='time' id='e_time' class='new_forms' required>";
    str += "<label for='sched'>Schedule</label><select id='sched'>";
    for(var i = 1; i < (schedules.length)+1; i++) {
        str += "<option value=" + i + ">" + schedules[i-1] + "</option>";
    }
    str += "</select>"
    str += "<label for='classroom'>Classroom</label><select id='room'>";
    for(var i = 1; i < (classrooms.length)+1; i++) {
        str += "<option value=" + i + ">" + classrooms[i-1] + "</option>";
    }
    str += "</select>";
    str += "<label for='campus'>Campus</label><select id='campus'>";
    for(var i = 1; i < (campuses.length)+1; i++) {
        str += "<option value=" + i + ">" + campuses[i-1] + "</option>";
    }
    str += "</select>";
    // str += "<label for='sched'>Class Schedule:</label><input type='text' id='classSched' class='new_forms' placeholder='e.g.: T Th 07:30 AM - 10:00 AM LB446TC TC' required>";
    str += "<input type='button' value='Add Class' class='option' id='confirmClass'>";
    str += "<input type='button' value='Go Back' class='option' onclick='location.reload();'>";

    $("#generatedForm").prepend(str);
    $("#confirmClass").on("click", ajax_addClass);
}

function ajax_addClass() {
    var group = $("#groupNum").val();
    var course = $("#courseCode").val();
    var s_time = $("#s_time").val();
    var e_time = $("#e_time").val();
    var sched = $("#sched").val();
    var room = $("#room").val();
    var campus = $("#campus").val();
    $.ajax({
        type: "POST",
        url: "ajax/addClass.php",
        data: {
            group: group,
            course: course,
            s_time: s_time,
            e_time: e_time,
            sched: sched,
            room: room,
            campus: campus
        },
        success: function (response) {
            $("#output").text(response);
            setTimeout(function() { location.reload(); }, 2000);
        },
        error: function(xhr, status, error) {
            console.error("Error updating row: " + error);
        }
    });
}

function dissolveClass() {
    $("#output").text("");
    $("#btnList").hide();
    $("#generatedForm").html("");
    var str = "";
    str += "<label for='group'>Enter Class ID:</label><input type='number' id='classID' class='new_forms' min=1 required>";
    str += "<input type='button' value='Dissolve Class' class='option' id='dissolveClass'>";
    str += "<input type='button' value='Go Back' class='option' onclick='location.reload();'>";

    $("#generatedForm").prepend(str);
    $("#dissolveClass").on("click", ajax_dissolveClass);
}

function ajax_dissolveClass() {
    var id = $("#classID").val();
    $.ajax({
        type: "POST",
        url: "ajax/dissolveClass.php",
        data: {
            id: id
        },
        success: function (response) {
            $("#output").text(response);
            setTimeout(function() { location.reload(); }, 2000);
        },
        error: function(xhr, status, error) {
            console.error("Error updating row: " + error);
        }
    });
}

function modifyClass() {
    $("#output").text("");
    $("#btnList").hide();
    $("#generatedForm").html("");
    var str = "";
    str += "<label for='group'>Enter Class ID:</label><input type='number' id='classID' class='new_forms' min=1 required>";
    str += "<input type='button' value='Modify Class' class='option' id='modifyClass'>";
    str += "<input type='button' value='Go Back' class='option' onclick='location.reload();'>";

    $("#generatedForm").prepend(str);
    $("#modifyClass").on("click", confirmModifyClass);
}

function confirmModifyClass() {
    var modifyID = $("#classID").val();
    $.ajax({
        type: "GET",
        url: "ajax/retrieveClass.php",
        data: {
            id: modifyID
        },
        dataType: "json",
        success: function (response) {
            if(response == -1) {
                $("#output").text("Invalid class ID!");
            } else {
                $("#output").text("");
                $("#btnList").hide();
                $("#generatedForm").html("");
                var str = "";
                str += "<label for='group'>Group Number</label><input type='number' id='groupNum' class='new_forms' min=1 required>";
                str += "<label for='code'>Course Code</label><input type='text' id='courseCode' class='new_forms' maxlength='30' required>";
                str += "<label for='s_time'>Start Time</label><input type='time' id='s_time' class='new_forms' required>";
                str += "<label for='e_time'>End Time</label><input type='time' id='e_time' class='new_forms' required>";
                str += "<label for='sched'>Schedule</label><select id='sched'>";
                for(var i = 1; i < (schedules.length)+1; i++) {
                    str += "<option value=" + i + ">" + schedules[i-1] + "</option>";
                }
                str += "</select>"
                str += "<label for='classroom'>Classroom</label><select id='room'>";
                for(var i = 1; i < (classrooms.length)+1; i++) {
                    str += "<option value=" + i + ">" + classrooms[i-1] + "</option>";
                }
                str += "</select>";
                str += "<label for='campus'>Campus</label><select id='campus'>";
                for(var i = 1; i < (campuses.length)+1; i++) {
                    str += "<option value=" + i + ">" + campuses[i-1] + "</option>";
                }
                str += "</select>";
                str += "<input type='button' value='Save Changes' class='option' id='confirmModifyClass'>";
                str += "<input type='button' value='Go Back' class='option' id='modifyReturn'>";

                $("#generatedForm").prepend(str);
                $("#confirmModifyClass").on("click", function() {
                    ajax_modifyClass(modifyID);
                });
                $("#modifyReturn").on("click", modifyClass);
            }
        },
        error: function(xhr, status, error) {
            console.error("Error updating row: " + error);
        }
    });
    
}

function ajax_modifyClass(modifyID) {
    var group = $("#groupNum").val();
    var course = $("#courseCode").val();
    var s_time = $("#s_time").val();
    var e_time = $("#e_time").val();
    var sched = $("#sched").val();
    var room = $("#room").val();
    var campus = $("#campus").val();
    $.ajax({
        type: "POST",
        url: "ajax/modifyClass.php",
        data: {
            id: modifyID,
            group: group,
            course: course,
            s_time: s_time,
            e_time: e_time,
            sched: sched,
            room: room,
            campus: campus
        },
        success: function (response) {
            $("#output").text(response);
            setTimeout(function() { location.reload(); }, 2000);
        },
        error: function(xhr, status, error) {
            console.error("Error updating row: " + error);
        }
    });
}

function addStudent() {
    var classID = $("#addStudent").attr('aria-label');
    $("#output").text("");
    $("#btnList").hide();
    $("#generatedForm").html("");

    var str = "";
    str += "<label for='name'>Student Name</label><input type='text' id='studentName' class='new_forms' required>";
    str += "<label for='id'>Student ID</label><input type='text' id='studentID' class='new_forms' required>";
    str += "<label for='course'>Student Course</label><select id='course'>";
    for(var i = 1; i < (courses.length)+1; i++) {
        str += "<option value=" + i + ">" + courses[i-1] + "</option>";
    }
    str += "</select>";
    str += "<input type='button' value='Add Student' class='option' id='confirmStudent'>";
    str += "<input type='button' value='Go Back' class='option' onclick='location.reload();'>";

    $("#generatedForm").prepend(str);
    $("#confirmStudent").on("click", function() {
        ajax_addStudent(classID);
    });
}

function ajax_addStudent(classID) {
    var name = $("#studentName").val();
    var id = $("#studentID").val();
    var course = $("#course").val();
    $.ajax({
        type: "POST",
        url: "ajax/addStudent.php",
        data: {
            classID: classID,
            name: name,
            id: id,
            course: course
        },
        success: function (response) {
            $("#output").text(response);
            setTimeout(function() { location.reload(); }, 2000);
        },
        error: function(xhr, status, error) {
            console.error("Error updating row: " + error);
        }
    });
}

function dropStudent() {
    var classID = $("#dropStudent").attr('aria-label');
    $("#output").text("");
    $("#btnList").hide();
    $("#generatedForm").html("");
    var str = "";
    str += "<label for='group'>Enter Student ID:</label><input type='number' id='studentID' class='new_forms' min=1 required>";
    str += "<input type='button' value='Drop Student' class='option' id='dropStudent'>";
    str += "<input type='button' value='Go Back' class='option' onclick='location.reload();'>";

    $("#generatedForm").prepend(str);
    $("#dropStudent").on("click", function() {
        ajax_dropStudent(classID);
    });
}

function ajax_dropStudent(classID) {
    var studentID = $("#studentID").val();
    $.ajax({
        type: "POST",
        url: "ajax/dropStudent.php",
        data: {
            studentID: studentID,
            classID: classID
        },
        success: function (response) {
            $("#output").text(response);
            setTimeout(function() { location.reload(); }, 2000);
        },
        error: function(xhr, status, error) {
            console.error("Error updating row: " + error);
        }
    });
}

function modifyStudent() {
    $("#output").text("");
    $("#btnList").hide();
    $("#generatedForm").html("");
    var str = "";
    str += "<label for='group'>Enter Student ID:</label><input type='number' id='studentID' class='new_forms' min=1 required>";
    str += "<input type='button' value='Modify Student' class='option' id='modifyStudent'>";
    str += "<input type='button' value='Go Back' class='option' onclick='location.reload();'>";

    $("#generatedForm").prepend(str);
    $("#modifyStudent").on("click", confirmModifyStudent);
}

function confirmModifyStudent() {
    var modifyID = $("#studentID").val();
    $.ajax({
        type: "GET",
        url: "ajax/retrieveStudent.php",
        data: {
            id: modifyID
        },
        dataType: "json",
        success: function (response) {
            if(response == -1) {
                $("#output").text("Invalid class ID!");
            } else {
                $("#output").text("");
                $("#btnList").hide();
                $("#generatedForm").html("");
                var str = "";
                str += "<label for='group'>Student Name</label><input type='text' id='studentName' class='new_forms' value='" + response['studentName'] + "' required>";
                str += "<label for='course'>Student Course</label><select id='course'>";
                for(var i = 1; i < (courses.length)+1; i++) {
                    str += "<option value=" + i + ">" + courses[i-1] + "</option>";
                }
                str += "</select>";
                str += "<input type='button' value='Save Changes' class='option' id='confirmModifyStudent'>";
                str += "<input type='button' value='Go Back' class='option' id='modifyReturn'>";

                $("#generatedForm").prepend(str);
                $("#confirmModifyStudent").on("click", function() {
                    ajax_modifyStudent(modifyID);
                });
                $("#modifyReturn").on("click", modifyStudent);
            }
        },
        error: function(xhr, status, error) {
            console.error("Error updating row: " + error);
        }
    });
}

function ajax_modifyStudent(modifyID) {
    var name = $("#studentName").val();
    var course = $("#course").val();
    $.ajax({
        type: "POST",
        url: "ajax/modifyStudent.php",
        data: {
            mid: modifyID,
            name: name,
            course: course,
        },
        success: function (response) {
            $("#output").text(response);
            setTimeout(function() { location.reload(); }, 2000);
        },
        error: function(xhr, status, error) {
            console.error("Error updating row: " + error);
        }
    });
}

function addExam() {
    var classID = $("#addExam").attr('aria-label');
    $("#output").text("");
    $("#btnList").hide();
    $("#generatedForm").html("");

    var str = "";
    str += "<label for='name'>Exam Name</label><input type='text' id='examName' class='new_forms' required>";
    str += "<label for='exam_s'>Exam Start</label><input type='datetime-local' id='exam_start' class='new_forms' required>";
    str += "<label for='exam_e'>Exam End</label><input type='datetime-local' id='exam_end' class='new_forms' required>";
    str += "<label for='name'>Total Score</label><input type='number' id='totalScore' class='new_forms' min=0 required>";
    str += "<label for='name'>Passing Score</label><input type='number' id='passingScore' class='new_forms' min=0 required>";
    str += "<label for='term'>Assigned Term</label><select id='term'><option value='Midterms'>Midterms</option><option value='Finals'>Finals</option></select>";
    str += "<input type='button' value='Add Exam' class='option' id='confirmExam'>";
    str += "<input type='button' value='Go Back' class='option' onclick='location.reload();'>";

    $("#generatedForm").prepend(str);
    $("#confirmExam").on("click", function() {
        ajax_addExam(classID);
    });
}

function ajax_addExam(classID) {

    var name = $("#examName").val();
    var start = $("#exam_start").val();
    var end = $("#exam_end").val();
    var t_score = $("#totalScore").val();
    var p_score = $("#passingScore").val();
    var term = $("#term").val();

    $.ajax({
        type: "POST",
        url: "ajax/addExam.php",
        data: {
            classID: classID,
            name: name,
            start: start,
            end: end,
            t_score: t_score,
            p_score: p_score,
            term: term
        },
        success: function (response) {
            $("#output").text(response);
            setTimeout(function() { location.reload(); }, 2000);
        },
        error: function(xhr, status, error) {
            console.error("Error updating row: " + error);
        }
    });
}

function removeExam() {
    $("#output").text("");
    $("#btnList").hide();
    $("#generatedForm").html("");
    var str = "";
    str += "<label for='group'>Enter Exam ID:</label><input type='number' id='examID' class='new_forms' min=1 required>";
    str += "<input type='button' value='Remove Exam' class='option' id='removeExam'>";
    str += "<input type='button' value='Go Back' class='option' onclick='location.reload();'>";

    $("#generatedForm").prepend(str);
    $("#removeExam").on("click", function() {
        ajax_removeExam();
    });
}

function ajax_removeExam() {
    var examID = $("#examID").val();
    $.ajax({
        type: "POST",
        url: "ajax/removeExam.php",
        data: {
            examID: examID
        },
        success: function (response) {
            $("#output").text(response);
            setTimeout(function() { location.reload(); }, 2000);
        },
        error: function(xhr, status, error) {
            console.error("Error updating row: " + error);
        }
    });
}

function modifyExam() {
    $("#output").text("");
    $("#btnList").hide();
    $("#generatedForm").html("");
    var str = "";
    str += "<label for='group'>Enter Exam ID:</label><input type='number' id='examID' class='new_forms' min=1 required>";
    str += "<input type='button' value='Modify Exam' class='option' id='modifyExam'>";
    str += "<input type='button' value='Go Back' class='option' onclick='location.reload();'>";

    $("#generatedForm").prepend(str);
    $("#modifyExam").on("click", confirmModifyExam);
}

function confirmModifyExam() {
    var modifyID = $("#examID").val();
    $.ajax({
        type: "GET",
        url: "ajax/retrieveExam.php",
        data: {
            id: modifyID
        },
        dataType: "json",
        success: function (response) {
            if(response == -1) {
                $("#output").text("Invalid exam ID!");
            } else {
                $("#output").text("");
                $("#btnList").hide();
                $("#generatedForm").html("");
                var str = "";
                str += "<label for='group'>Exam Name</label><input type='text' id='examName' class='new_forms' value='" + response['examName'] + "' min=1 required>";
                str += "<label for='code'>Exam Start</label><input type='datetime-local' id='exam_start' class='new_forms'value='" + response['exam_s_date'] + "' required>";
                str += "<label for='exam_e'>Exam End</label><inpuit type='datetime-local' id='exam_end' class='new_forms' value='" + response['exam_e_date'] + "' required>";
                str += "<label for='sched'>Total Score:</label><input type='number' id='totalScore' class='new_forms' value='" + response['totalScore'] + "'>";
                str += "<label for='sched'>Passing Score:</label><input type='number' id='passingScore' class='new_forms' value='" + response['passingScore'] + "'>";
                str += "<label for='term'>Assigned Term</label><select id='term'><option value='Midterms'>Midterms</option><option value='Finals'>Finals</option></select>";
                str += "<input type='button' value='Save Changes' class='option' id='confirmModifyExam'>";
                str += "<input type='button' value='Go Back' class='option' id='modifyReturn'>";

                $("#generatedForm").prepend(str);
                $("#confirmModifyExam").on("click", function() {
                    ajax_modifyExam(modifyID);
                });
                $("#modifyReturn").on("click", modifyExam);
            }
        },
        error: function(xhr, status, error) {
            console.error("Error updating row: " + error);
        }
    });
    
}

function ajax_modifyExam(modifyID) {
    var name = $("#examName").val();
    var start = $("#exam_start").val();
    var end = $("#exam_end").val();
    var t_score = $("#totalScore").val();
    var p_score = $("#passingScore").val();
    var term = $("#term").val();

    $.ajax({
        type: "POST",
        url: "ajax/modifyExam.php",
        data: {
            id: modifyID,
            name: name,
            start: start,
            end: end,
            t_score: t_score,
            p_score: p_score,
            term: term
        },
        success: function (response) {
            $("#output").text(response);
            setTimeout(function() { location.reload(); }, 2000);
        },
        error: function(xhr, status, error) {
            console.error("Error updating row: " + error);
        }
    });
}

function addEntry() {
    var examID = $("#addEntry").attr('aria-label');
    $("#output").text("");
    $("#btnList").hide();
    $("#generatedForm").html("");

    var str = "";
    str += "<label for='name'>Student ID</label><input type='number' id='studentID' class='new_forms' required>";
    str += "<label for='course'>Student's Score</label><input type='number' id='studentScore' class='new_forms' required>";
    str += "<input type='button' value='Add Entry' class='option' id='confirmEntry'>";
    str += "<input type='button' value='Go Back' class='option' onclick='location.reload();'>";

    $("#generatedForm").prepend(str);
    $("#confirmEntry").on("click", function() {
        ajax_addEntry(examID);
    });
}

function ajax_addEntry(examID) {

    var studentID = $("#studentID").val();
    var studentScore = $("#studentScore").val();

    $.ajax({
        type: "POST",
        url: "ajax/addEntry.php",
        data: {
            examID: examID,
            studentID: studentID,
            studentScore: studentScore
        },
        success: function (response) {
            $("#output").text(response);
            setTimeout(function() { location.reload(); }, 2000);
        },
        error: function(xhr, status, error) {
            console.error("Error updating row: " + error);
        }
    });
}

function removeEntry() {
    $("#output").text("");
    $("#btnList").hide();
    $("#generatedForm").html("");
    var str = "";
    str += "<label for='group'>Enter Entry ID:</label><input type='number' id='entryID' class='new_forms' min=1 required>";
    str += "<input type='button' value='Remove Entry' class='option' id='removeEntry'>";
    str += "<input type='button' value='Go Back' class='option' onclick='location.reload();'>";

    $("#generatedForm").prepend(str);
    $("#removeEntry").on("click", function() {
        ajax_removeEntry();
    });
}

function ajax_removeEntry() {
    var entryID = $("#entryID").val();
    $.ajax({
        type: "POST",
        url: "ajax/removeEntry.php",
        data: {
            entryID: entryID
        },
        success: function (response) {
            $("#output").text(response);
            setTimeout(function() { location.reload(); }, 2000);
        },
        error: function(xhr, status, error) {
            console.error("Error updating row: " + error);
        }
    });
}

function modifyEntry() {
    $("#output").text("");
    $("#btnList").hide();
    $("#generatedForm").html("");

    var str = "";
    str += "<label for='group'>Enter Entry ID:</label><input type='number' id='entryID' class='new_forms' min=1 required>";
    str += "<input type='button' value='Modify Entry' class='option' id='modifyEntry'>";
    str += "<input type='button' value='Go Back' class='option' onclick='location.reload();'>";

    $("#generatedForm").prepend(str);
    $("#modifyEntry").on("click", confirmModifyEntry);
}

function confirmModifyEntry() {
    var modifyID = $("#entryID").val();
    $.ajax({
        type: "GET",
        url: "ajax/retrieveEntry.php",
        data: {
            id: modifyID
        },
        dataType: "json",
        success: function (response) {
            if(response == -1) {
                $("#output").text("Invalid entry ID!");
            } else {
                $("#output").text("");
                $("#btnList").hide();
                $("#generatedForm").html("");
                var str = "";
                str += "<label for='group'>Student ID</label><input type='number' id='studentID' class='new_forms' value='" + response['studentID'] + "' min=1 required>";
                str += "<label for='code'>Student's Score</label><input type='number' id='studentScore' class='new_forms'value='" + response['score'] + "' required>";
                str += "<input type='button' value='Save Changes' class='option' id='confirmModifyEntry'>";
                str += "<input type='button' value='Go Back' class='option' id='modifyReturn'>";

                $("#generatedForm").prepend(str);
                $("#confirmModifyEntry").on("click", function() {
                    ajax_modifyEntry(modifyID);
                });
                $("#modifyReturn").on("click", modifyEntry);
            }
        },
        error: function(xhr, status, error) {
            console.error("Error updating row: " + error);
        }
    });
    
}

function ajax_modifyEntry(modifyID) {
    var studentID = $("#studentID").val();
    var score = $("#studentScore").val();

    $.ajax({
        type: "POST",
        url: "ajax/modifyEntry.php",
        data: {
            id: modifyID,
            studentID: studentID,
            score: score
        },
        success: function (response) {
            $("#output").text(response);
            setTimeout(function() { location.reload(); }, 2000);
        },
        error: function(xhr, status, error) {
            console.error("Error updating row: " + error);
        }
    });
}

function importClass() {
    $("#output").text("");
    $("#btnList").hide();
    $("#generatedForm").html("");

    var str = "";
    str += "<form method='post' id='import-class' enctype='multipart/form-data'>";
    str += "<input type='hidden' name='MAX_FILE_SIZE' value='300000'>";
    str += "<input type='file' name='upload' id='upload' required>";
    str += "<input type='submit' value='Import Class' class='option' id='importClass'>";
    str += "<input type='button' value='Go Back' class='option' onclick='location.reload();'>";
    str += "</form>";

    $("#generatedForm").prepend(str);
}

function ajax_importClass(formData) {
    $.ajax({
        type: "POST",
        url: "ajax/importClass.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            $("#output").text(response);
            setTimeout(function() { location.reload(); }, 2000);
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
}

function setActivityHeaders() {
    $.ajax({
        type: "GET",
        url: "ajax/retrieveHeaders.php",
        dataType: "json",
        success: function(response){
            $("#g_classes").text(response[0]);
            $("#g_students").text(response[1]);
        },
        error: function(xhr, status, error) {
            console.error("Error updating row: " + error);
        }
    });
}

function initGlobalArrays() {
    $.ajax({
        type: "GET",
        url: "ajax/retrieveClassrooms.php",
        dataType: "json",
        success: function (response) {
            classrooms = response;
        }
    });
    
    $.ajax({
        type: "GET",
        url: "ajax/retrieveSchedules.php",
        dataType: "json",
        success: function (response) {
            schedules = response;
        }
    });

    $.ajax({
        type: "GET",
        url: "ajax/retrieveCampuses.php",
        dataType: "json",
        success: function (response) {
            campuses = response;
        }
    });

    $.ajax({
        type: "GET",
        url: "ajax/retrieveCourses.php",
        dataType: "json",
        success: function (response) {
            courses = response;
        }
    });
}

$(function() {
    for(var i = 0; i < buttons.length; i++) $(buttons[i][0]).on("click", buttons[i][1]);
    $(".viewClass").each(function() {
        $(this).on("click", function() {
            var id = $(this).attr('aria-label');
            window.location.href = 'viewclass.php?id=' + id;
        });
    })

    $(".viewStudent").each(function() {
        $(this).on("click", function() {
            var id = $(this).attr('aria-label');
            window.location.href = 'viewstudent.php?id=' + id;
        })
    })
    
    $(".viewExam").each(function() {
        $(this).on("click", function() {
            var id = $(this).attr('aria-label');
            window.location.href = 'viewexam.php?id=' + id;
        })
    })
    
    setActivityHeaders();
    initGlobalArrays();
});
