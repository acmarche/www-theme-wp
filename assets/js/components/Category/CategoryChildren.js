import { fetchCategories } from './service/categories-service';
import CategoryItem from './CategoryItem';

const {
    useState,
    useEffect
} = wp.element;

function CategoryChildren( propos ) {
    const [ categories, setCategories ] = useState([]);
    const [ loading, setLoading ] = useState( false );

    async function loadCategories() {
        setLoading( true );
        let response;
        try {
            response = await fetchCategories( propos.siteSlug, propos.catId );
            setCategories( response.data );
            setLoading( false );
        } catch ( e ) {
            setLoading( false );
        }
        return null;
    }

    useEffect( () => {
        if ( 0 < propos.catId ) {
            loadCategories();
        }
    }, [ propos.catId ]);

    function setItemActive( idCat ) {
        categories.map( ( object ) => {
            if ( object.id === idCat ) {
                return Object.assign( object, { active: true });
            }
            return Object.assign( object, { active: false });
        });
    }

    const listItems = categories.map( ( object, index ) => (
        <CategoryItem
            item={object}
            key={object.id}
            setItemActive={setItemActive}
            setSelectedCategory={propos.setSelectedCategory}
            setSelectedCategoryTitle={propos.setSelectedCategoryTitle}
        />
    ) );

    return (
        <div className="overflow-hidden w-100 pt-48px col-6 px-0">
            <ul className="object-tags">
                {listItems}
            </ul>
        </div>
    );
}

export default CategoryChildren;
