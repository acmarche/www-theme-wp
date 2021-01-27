import CollapseCategory from "./CollapseCategory";
import PopupDescription from "./PopupDescription";

function Filtre({
  setPopupDescription,
  popupDescription,
  categoriesToDisplay,
  setCategoriesToDisplay,
  markerData,
  setMarkerData,
  parentCategoriesToDisplay,
}) {
  return (
    <div className="col-12 col-lg-3 px-0 lg-shadow-sm-1 position-relative z-10">
      {popupDescription && window.innerWidth > 992 ? (
        <PopupDescription
          setPopupDescription={setPopupDescription}
          popupDescription={popupDescription}
        />
      ) : (
        <div>
          {parentCategoriesToDisplay?.map((parentCategoryObject, index) => {
            return (
              <CollapseCategory
                setMarkerData={setMarkerData}
                key={index}
                parentCategoryObject={parentCategoryObject}
                categoriesToDisplay={categoriesToDisplay}
                setCategoriesToDisplay={setCategoriesToDisplay}
                markerData={markerData}
                targetControlIdCollapse={`Collapse${index}`}
              />
            );
          })}
        </div>
      )}
    </div>
  );
}

export default Filtre;
