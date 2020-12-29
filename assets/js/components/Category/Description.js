import React from "react";

const { useEffect } = wp.element;

function Description(props) {
  useEffect(() => {
    if (props.selectedCategory !== 0) {
      let filteredCategoryDescription = props.categories.filter((object) => {
        return object.id == props.selectedCategory;
      });
      props.setFilteredCategoryDescription(
        filteredCategoryDescription[0].description
      );
    } else {
      props.setFilteredCategoryDescription("");
    }
  }, [props.categories, props.selectedCategory]);

  if (props.filteredCategoryDescription !== "") {
    return (
      <p
        dangerouslySetInnerHTML={{
          __html: props.filteredCategoryDescription,
        }}
      />
    );
  } else {
    return null;
  }
}

export default Description;
