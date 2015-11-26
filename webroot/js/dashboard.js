var concordiaUrl = 'http://concordia.vm.wmi.amu.edu.pl:8800';

function next() {
    current = jQuery.data(document.body, "current");
    $('#input'+current).toggleClass("selected");
    current++;
    $('#input'+current).toggleClass("selected");
    jQuery.data(document.body, "current", current);
    searchConcordia();
}

function getCurrentSegment() {
    current = jQuery.data(document.body, "current");
    return $('div#input'+current+' div.input-text').html();
}

function initiateTranslation() {    
    alert('init');
    searchConcordia();
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
    
//    var score = data['result']['bestOverlayScore']*100;
//    res += '<div id="result-score">Concordia score: <b>'+score.toFixed(0)+'%</b></div>';
    
    var inputSentence = $('div#input'+current+' div.input-text').html();
    
    var markedSentence = '';
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
}
