import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import React from 'react'; // Import React if not already imported
import { Head ,Link,router } from "@inertiajs/react";
import Pagination from "@/Components/pagination";
import { PROJECT_STATUS_CLASS_MAP, PROJECT_STATUS_TEXT_MAP } from "@/constans";
import TextInput from "@/Components/TextInput";
import SelectInput from "@/Components/SelectInput";


export default function index({auth,projects , queryParams = null }){
    queryParams = queryParams || {}
    const searchForChenges = (name,value)=>{
        if(value){
            queryParams[name] = value ;
        }
        else
            delete queryParams[name] ;

        router.get(route('project.index',queryParams))
    }
    const onKeyPress =(name,e)=>{
        if(e.key !== 'Enter') return;

        searchForChenges(name,e.target.value)
    }
    const sortChanged = (name) => {
        
        if (name === queryParams.sort_field) {
            if (queryParams.sort_direction === "asc") {
            queryParams.sort_direction = "desc";
            } else {
            queryParams.sort_direction = "asc";
            }
        } else{
            queryParams.sort_field = name;
            queryParams.sort_direction = "asc";
            } 
        router.get(route("project.index"), queryParams);
    }
    return( 
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Projects liste</h2>}
        >
    
    <Head title="Projects" />


    <div className="py-12">
        <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div className="p-6 text-gray-900 dark:text-gray-100">
                    
                    <table className="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead className="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr className="text-nowrap">
                                <th className="px-3 py-2" onClick={e => sortChanged('id')} > ID</th>
                                <th className="px-3 py-2">Image</th>
                                <th className="px-3 py-2" onClick={e => sortChanged('name')}>Name</th>
                                <th className="px-3 py-2">Status</th>
                                <th className="px-3 py-2" onClick={e => sortChanged('created_at')}>Create Date</th>
                                <th className="px-3 py-2" onClick={e => sortChanged('due_date')}>Due Date</th>
                                <th className="px-3 py-2">Create By</th>
                                <th className="px-3 py-2">Actions</th>
                            </tr>
                        </thead>

                        <thead className="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr className="text-nowrap">
                                <th className="px-3 py-2"></th>
                                <th className="px-3 py-2"></th>
                                <th className="px-3 py-2">
                                    <TextInput  
                                    className="w-full"
                                    defaultValue={queryParams.name}
                                    placeholder="Project name"
                                    onBlur={e => searchForChenges('name',e)}
                                    onKeyPress={e => onKeyPress('name',e)}/>
                                </th>
                                <th className="px-3 py-2">
                                    <SelectInput 
                                        className="w-full"
                                        defaultValue={queryParams.status}
                                        onChange={e => searchForChenges('status',e.target.value)}>
                                            <option value="all" >Select Status</option>
                                            <option value="pending">Pending</option>
                                            <option value="in_progress">In Progress</option>
                                            <option value="complated">Completed</option>
                                        </SelectInput>
                                </th>
                                <th className="px-3 py-2"></th>
                                <th className="px-3 py-2"></th>
                                <th className="px-3 py-2"></th>
                                <th className="px-3 py-2"></th>
                            </tr>
                        </thead>

                        <tbody>
                            {projects.data.map(project=>(
                                <tr className="bg-white border-b dark:bg-gray-800 dark:border-gray-700" key={project.id}>
                                    <td className="px-3 py-2">{project.id}</td>
                                    <td className="px-3 py-2">
                                        <img src={project.image_path} className="w-44" alt="" />
                                    </td>
                                    <td className="px-3 py-2 hover:underline text-gray-100">
                                        <Link href={route("project.show" , project.id)}>
                                        {project.name}
                                        </Link>
                                        </td>
                                    <td className="px-3 py-2">
                                        <span className={ "px-2 py-1 rounded text-white " + 
                                                            PROJECT_STATUS_CLASS_MAP[project.status] } >
                                            {PROJECT_STATUS_TEXT_MAP[project.status]}
                                        </span>
                                    </td>
                                    <td className="px-3 py-2">{project.created_at}</td>
                                    <td className="px-3 py-2">{project.due_date}</td>
                                    <td className="px-3 py-2">{project.createdBy.name}</td>
                                    

                                    <td className="px-3 py-2">
                                    <Link href={route("project.edit", project.id)}
                                        className="font-medium text-blue-600 dark:text-blue-500 hover:underline mx-1">
                                        Edit
                                    </Link>
                                    <Link href={route("project.destroy", project.id)}
                                            className="font-medium text-red-600 dark:text-red-500 hover:underline mx-1"> I
                                        Delete
                                    </Link>
                                    </td>

                                    
                                </tr>
                            ))}
                           
                        </tbody>
                    </table>
                    <Pagination links={projects.meta.links}/>
                </div> 
            </div>
        </div>
    </div>
        </AuthenticatedLayout>
    )
}