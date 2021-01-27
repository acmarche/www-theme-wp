import Axios from '../Axios';
import MapComponent from './MapComponent';
import Filtre from './Filtre';
import Top from './Top';

const { useState, useEffect } = wp.element;

function App() {
    const [ markerData, setMarkerData ] = useState([]);
    const [ categoriesToDisplay, setCategoriesToDisplay ] = useState([]);
    const [ parentCategoriesToDisplay, setParentCategoriesToDisplay ] = useState(
        []
    );
    const [ popupDescription, setPopupDescription ] = useState();

    useEffect( () => {
        const parentCategoriesToDisplay = [
            {
                ParentCategoryId: 490,
                ParentCategoryName: 'Emploi - Formation',
                ParentCategoryIcon: 'fas fa-briefcase'
            },
            {
                ParentCategoryId: 104,
                ParentCategoryName: 'Horeca',
                ParentCategoryIcon: 'fas fa-utensils'
            },
            {
                ParentCategoryId: 494,
                ParentCategoryName: 'Famille',
                ParentCategoryIcon: 'fas fa-user-friends'
            }
        ];
        setParentCategoriesToDisplay( parentCategoriesToDisplay );
    }, []);

    //Fetching CategoriesToDisplay
    const getCategoryToDisplay = () => {
        Axios.get( 'https://new.marche.be/wp-json/ca/v1/bottinAllCategories' )
            .then( ( res ) => {
                if ( 0 !== res.data.length ) {
                    const allCategories = res.data;
                    const filteredCategories = [];
                    parentCategoriesToDisplay.forEach( ( parent ) => {
                        filteredCategories.push(
                            ...allCategories.filter(
                                ( cat ) => cat.parent_id == parent.ParentCategoryId
                            )
                        );
                    });
                    console.log( '4444444', filteredCategories );
                    setCategoriesToDisplay( filteredCategories );
                } else {
                    return null;
                }
            })
            .catch( ( err ) => console.log( err.message ) );
    };

    useEffect( () => {
        getCategoryToDisplay();
    }, [ parentCategoriesToDisplay ]);

    window.addEventListener( 'resize', () => {
        950 < window.innerWidth && 992 > window.innerWidth ?
            window.location.reload() :
            null;
    });

    return (
        <>
            <div className="bg-white pt-24px px-24px position-relative d-md-flex px-xl-48px mx-xl-n30px justify-content-md-center flex-column">
                <Top />
                <div className="mt-48px d-flex flex-column flex-lg-row mx-0 mx-lg-n48px overflow-hidden align-items-lg-stretch mx-xxl-0 xxl-shadow-sm-1">
                    <Filtre
                        setPopupDescription={setPopupDescription}
                        popupDescription={popupDescription}
                        categoriesToDisplay={categoriesToDisplay}
                        markerData={markerData}
                        setMarkerData={setMarkerData}
                        parentCategoriesToDisplay={parentCategoriesToDisplay}
                    />

                    <MapComponent
                        popupDescription={popupDescription}
                        setPopupDescription={setPopupDescription}
                        markerData={markerData}
                    />
                </div>
            </div>
        </>
    );
}

export default App;
