function limitLines(element, lineLimit)
{
    let maxHeight = parseInt($(element).css('line-height')) * lineLimit;
    while($(element).height() > maxHeight) {
        let text = $(element).text();
        $(element).text(text.substring(0,text.length-5)).text($(element).text()+'...');
    }
}