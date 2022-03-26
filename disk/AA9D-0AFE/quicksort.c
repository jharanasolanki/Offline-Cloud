#include<stdio.h>
#define MAX 100
int arr[MAX];
int partition(int low,int high)
{
	int pivot,i,j,temp;
	pivot=arr[high];
	i=low-1;
	for(j=low;j<high;j++)
	{
		if(arr[j]<pivot)
		{
			i++;
			temp=arr[i];
			arr[i]=arr[j];
			arr[j]=temp;
		}
	}
	temp=arr[i+1];
	arr[i+1]=arr[j];
	arr[j]=temp;
	return i+1;

}
void quicksort(int low,int high)
{
	int pi;
	if(low<high)
	{
		pi=partition(low,high);
		quicksort(low,pi-1);
		quicksort(pi+1,high);
	}
}
int main()
{
	int n,i;
	scanf("%d",&n);
	for(i=0;i<n;i++)
	{
		scanf("%d",&arr[i]);
	}
	quicksort(0,n-1);
	for(i=0;i<n;i++)
	{
		printf("%d\t",arr[i]);
	}
	return 0;
}
