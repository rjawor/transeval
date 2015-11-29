var concordiaUrl = 'http://concordia.vm.wmi.amu.edu.pl:8800';

function next() {
    current = jQuery.data(document.body, "current");
    $('#input'+current).toggleClass("selected");
    acceptTranslation();
    
    current++;
    
    count = jQuery.data(document.body, "count");
    $('#input'+current).toggleClass("selected");
    jQuery.data(document.body, "current", current);
    if (current == count) {
        window.location.replace('/transeval/assignments/thankyou');
    } else {
        initiateTranslation();
    }
}

function getCurrentSegment() {
    current = jQuery.data(document.body, "current");
    return $('div#input'+current+' div.input-text').html();
}

function initiateTranslation() {
    current = jQuery.data(document.body, "current");   
    $.ajax({
        url: '/transeval/targets/add',
        headers: {          
             Accept : 'application/json'   
        }, 
        type: 'post',
        data: {
                  input_id:$('#input'+current+' .input-id').val(),
                  user_id:$('#input'+current+' .user-id').val()
              },
        success: function (data) {
            $('#input'+current+' .target-id').val(data.target.id);
        },
    });
    searchConcordia();
}

function acceptTranslation() {
    current = jQuery.data(document.body, "current");   
    $.ajax({
        url: '/transeval/targets/accept',
        headers: {          
             Accept : 'application/json'   
        }, 
        type: 'post',
        data: {
                  target_id:$('#input'+current+' .target-id').val(),
                  content:$('#input'+current+' .target-field textarea').val()
              }
    });
}


function searchConcordia() {    
    var concordiaRequest = {
        operation: 'concordiaSearch',
        tmId: 2,
        pattern:getCurrentSegment()
    }
    
    $.ajax({
        url: concordiaUrl,
        type: 'post',
        dataType: 'json',
        success: function (data) {
            renderResult(data);
        },
        data: JSON.stringify(concordiaRequest)
    });
    
}

function renderResult(data) {
    current = jQuery.data(document.body, "current");
    
    var markedSentence = '';

    var pureScore = data['result']['bestOverlayScore'];
    var score = pureScore*100;
    markedSentence += '<input type="hidden" class="exact-result-score" value="'+pureScore+'" />';
    markedSentence += '<span class="result-score">'+score.toFixed(0)+'%</span>';
    
    var inputSentence = $('div#input'+current+' div.input-text').html();
    
    var fragments = '';
    lastInsertedEnd = 0;
    for(var i = 0; i < data['result']['bestOverlay'].length; i++) {
        var fragment = data['result']['bestOverlay'][i];
        //previous unmarked fragment
        markedSentence += inputSentence.slice(lastInsertedEnd, fragment['matchedPatternStart']);

        //the marked fragment
        markedSentence += '<span id="fragment'+current+'-'+i+'" onclick="displayDetails('+i+')" class="matchedFragment">'+inputSentence.slice(fragment['matchedPatternStart'], fragment['matchedPatternEnd'])+'</span>';
        
        lastInsertedEnd = fragment['matchedPatternEnd'];
        
        fragments += renderFragment(fragment, current, i);
    }
    
    //remaining unmarked fragment
    markedSentence += inputSentence.slice(lastInsertedEnd);
    
    $('div#input'+current+' div.input-text-concordia').html(markedSentence);
    $('div#input'+current+' div.suggestions').html(fragments);
        
}

function renderFragment(fragment, segment, number) {
    var result = '<div id="details'+segment+'-'+number+'" class="fragmentDetails"><table><tr><td>';

    var sourceSegment = fragment['sourceSegment'];
    result += sourceSegment.slice(0, fragment['matchedExampleStart']);
    result += '<span class="matchedFragment">';
    result += sourceSegment.slice(fragment['matchedExampleStart'], fragment['matchedExampleEnd']);
    result += '</span>';
    result += sourceSegment.slice(fragment['matchedExampleEnd']);
    
    result += '</td></tr><tr><td>'+fragment['targetSegment']+'</td></tr></table></div>';
    return result;
}

function displayDetails(number) {
    current = jQuery.data(document.body, "current");
    $('div.input-segment .input-text-concordia .matchedFragment').removeClass('selected');
    $('#fragment'+current+'-'+number).addClass('selected');

    $('.fragmentDetails').removeClass('selected');

    $('#details'+current+'-'+number).addClass('selected');
    
    $.ajax({
        url: '/transeval/concordiaUses/add',
        headers: {          
             Accept : 'application/json'   
        }, 
        type: 'post',
        data: {
                  overlay_score:$('#input'+current+' .input-text-concordia .exact-result-score').val(),
                  target_id:$('#input'+current+' .target-id').val(),
                  fragment:$('#fragment'+current+'-'+number).html(),
                  word_count:$('#fragment'+current+'-'+number).html().split(' ').length
              }
    });

}
