import { fetchCategories } from './service/categories-service';
import CategoryItem from './CategoryItem';
import CategoryItemOption from './CategoryItemOption';

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

    const listItems = categories.map( ( object ) => (
        <CategoryItem
            item={object}
            key={object.id}
            setItemActive={setItemActive}
            setSelectedCategory={propos.setSelectedCategory}
            setSelectedCategoryTitle={propos.setSelectedCategoryTitle}
        />
    ) );

    function changeSelectedCategory( event ) {
        let categoryId = event.target.getAttribute( 'data-category-id' );
        let categoryTitle;
        if ( null == categoryId ) {
            categoryId = event.target.value;
        }
        // eslint-disable-next-line prefer-const
        categoryTitle = event.target.getAttribute( 'data-category-name' );
        console.log( categoryTitle );
        setItemActive( categoryId );
        propos.setSelectedCategory( categoryId );
        propos.setSelectedCategoryTitle( categoryTitle );
        document.title = categoryTitle;
    }

    const options = categories.map( ( object ) => (
        <CategoryItemOption
            item={object}
            key={object.id}
            setItemActive={setItemActive}
            setSelectedCategory={propos.setSelectedCategory}
            setSelectedCategoryTitle={propos.setSelectedCategoryTitle}
        />
    ) );

    return (
        <>
            <div className="d-lg-none pr-12px border border-dark-primary mt-48px">
                <select
                    name="categories"
                    id="cat-select"
                    className="fs-short-3 ff-semibold"
                    onChange={( e ) => {
                        changeSelectedCategory( e );
                    }}
                >
                    {options}
                </select>
            </div>
            <div className="d-none d-lg-block overflow-hidden w-100 pt-48px col-6 px-0">
                <ul className="object-tags">
                    {listItems}
                </ul>
            </div>
        </>
    );
}

export default CategoryChildren;
