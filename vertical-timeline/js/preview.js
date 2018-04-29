$(document).ready(function () {
sortUsingNestedText($('#cd-timeline'), "div", "span.cd-date");
});
function sortUsingNestedText(parent, childSelector, keySelector) {
    var items = parent.children(childSelector).sort(function(a, b) {
        var vA = $(keySelector, a).text();
        var vB = $(keySelector, b).text();
        return (vA < vB) ? -1 : (vA > vB) ? 1 : 0;
    });
    parent.append(items);
}
