# sticky-jqyery-plugin
Simple plugin for jquery project

Needed only for medium and above device screen sizes for the project.

```

    //paddingTop = Height from the top of the document to the start position of scrolling container
    //heightRefElement = id/class of the last element from which the sticky has to stop
    //optionalBottonFix = Sometimes it needs to be added to fix the bottom scrolling position in DOM(optional)
    //optionalTopFix = Sometimes it needs to be added to fix the top scrolling position in DOM(optional)

  	$('.sticky-content').StickyDL({
 	    paddingTop : 220, 
 		heightRefElement: '.main-content-end-padding', 
        optionalBottomFix: 95,
        optionalTopFix: 0
 	})

```
